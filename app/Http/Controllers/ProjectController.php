<?php

namespace App\Http\Controllers;

use App\Team;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $retval = [];

        $coffee = [];
        $coffee['id'] = 1;
        $coffee['name'] = "Coffee Shop USA";
        $coffee['lastUpdated'] = "4 Days Ago";

        $startup = [];
        $startup['id'] = 2;
        $startup['name'] = "Next Big Thing, Inc";

        $corporation = [];
        $corporation['id'] = 3;
        $corporation['name'] = "Large Corporation";

        $condo = [];
        $condo['id'] = 4;
        $condo['name'] = "Downtown Condos";

        $arts = [];
        $arts['id'] = 5;
        $arts['name'] = "Local Arts Organization";

        array_push($retval, $coffee, $startup, $corporation, $condo, $arts);

        return $retval;
    }

    /**
     * Get all projects of currently selected team
     *
     */
    public function teamProjects(Team $team) 
    {
        $user = Auth::user();

        if ($user->id !== $team->user_id) {
            return 'You do not have permission to edit this team!';
        }

        $projects = $team->projects;
        return $projects;
    }

    /**
     * Creates new project
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $user = Auth::user();
        $team_id = $request->teamID;
        $team = Team::find($team_id);

        if ( empty($team) ) {
            return "Team does no exist!";
        }

        if ($user->id !== $team->user_id) {
            return 'You do not have permission to edit this team!';
        }

        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->subtitle = $request->subtitle;
        $project->team_id = $team_id;
        $project->save();
    }

    public function show($id)
    {
        if ($id == 1) {
            $retval = [];
            $retval['name'] = "Coffee Shop USA";
            $retval['id'] = $id;
            $retval['subtitle'] = "For Your Caffeine Fix!";
            $retval['description'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
            $retval['brandings'] = [
                [
                    'slug'  => 'colors',
                    'name'  => 'Colors',
                ],
                [
                    'slug'  => 'fonts',
                    'name'  => 'Fonts',
                ],
                [
                    'slug'  => 'typography',
                    'name'  => 'Typography',
                ],
                [
                    'slug'  => 'logos',
                    'name'  => 'Logos',
                ],
            ];
            return $retval;
        }
        if ($id == 2) {
            $retval = [];
            return $retval;
        }
        return "no :(";
    }

    public function logos($project_id) {
        $retval = [];
        $project = $this->show($project_id);
        if ( $project_id == 1 ) {

            $logos = [
                [
                    'name'  => 'Main Logo',
                    'src'   => '/images/coffee-shop.svg'
                ]
            ];

            $social = [
                [
                    'name'      => 'Facebook',
                    'src'       => '/images/facebook.svg',
                ],
                [
                    'name'      => 'Twitter',
                    'src'       => '/images/twitter.svg',
                ],
                [
                    'name'      => 'Instagram',
                    'src'       => '/images/instagram.svg',
                ],
                [
                    'name'      => 'Location',
                    'src'       => '/images/location.svg',
                ],
                [
                    'name'      => 'Mail',
                    'src'       => '/images/mail.svg',
                ],
            ];

            $icons = [
                [
                    'name'    => 'Logos',
                    'icons'   => $logos,
                ],
                [
                    'name'    => 'Social Icons',
                    'icons'   => $social,
                    'display' => 'compact',
                ],
            ];
        }

        $retval['project'] = $project;
        $retval['icons'] = $icons;

        return $retval;
    }


    public function colors($project_id)
    {
        $retval = [];
        $project = $this->show($project_id);

        if ( $project_id == 1 ) {
            $primary = [
                [
                    'name'          => "Coffee Brown",
                    'definition'    => [
                        'type'      => 'hex',
                        'value'     => '5A352A',
                    ],
                ],
                [
                    'name'          => "Red",
                    'definition'    => [
                        'type'      => 'hex',
                        'value'     => 'ff0000',
                    ],
                ],
            ];

            $alerts = [
                [
                    'name'  => 'Success',
                    'definition'  => [
                        'type'    => 'hex',
                        'value'   => 'abf2a5',
                    ],
                    'uses'  => 'This color is used for displaying messages regarding ',
                    'variable'  => 'alert-success',
                ],
                [
                    'name'  => 'Info',
                    'definition'  => [
                        'type'    => 'hex',
                        'value'   => '69ddff',
                    ],
                    'uses'  => 'This color is used for displaying messages regarding ',
                    'variable'  => 'alert-info',
                ],
                [
                    'name'  => 'Warning',
                    'definition'  => [
                        'type'    => 'hex',
                        'value'   => 'ffff31',
                    ],
                    'uses'  => 'This color is used for displaying messages regarding ',
                    'variable'  => 'alert-warning',
                ],
                [
                    'name'  => 'Danger',
                    'definition'  => [
                        'type'    => 'hex',
                        'value'   => 'f45b69',
                    ],
                    'uses'  => 'This color is used for displaying messages regarding ',
                    'variable'  => 'alert-danger',
                ],
            ];

            $brand = [
                [
                    'name'  => "Coffee",
                    'definition'  => [
                        'type'      => 'hex',
                        'value'     => '692e19',
                    ]
                ],
                [
                    'name'  => "Brown",
                    'definition'  => [
                        'type'      => 'hex',
                        'value'     => '8e6134',
                    ]
                ],
                [
                    'name'  => "Light Brown",
                    'definition'  => [
                        'type'      => 'hex',
                        'value'     => 'a97a45',
                    ]
                ],
            ];

            $grey = [
                [
                    'name'  => "Light Grey",
                    'definition'  => [
                        'type'      => 'hex',
                        'value'     => 'ddd',
                    ]
                ],
                [
                    'name'  => "Dark Grey",
                    'definition'  => [
                        'type'      => 'hex',
                        'value'     => '777',
                    ]
                ],
                [
                    'name'  => "Black",
                    'definition'  => [
                        'type'      => 'rgb',
                        'value'     => '0,0,0',
                    ]
                ],
            ];
            $spectrums = [
                [
                    'name'        => 'Brand Colors',
                    'colors'      => $brand,
                ],
                [
                    'name'        => 'Alerts',
                    'colors'      => $alerts,
                ],
                [
                    'name'        => 'Shades of Grey',
                    'colors'      => $grey,
                ]
            ];
        }

        $retval['spectrums'] = $spectrums;
        $retval['project'] = $project;
        return $retval;
    }

    public function fonts($project)
    {
        $retval = [];
        if ($project == 1) {

            $project = $this->show($project);
            $retval['project'] = $project;

            $branding['fonts'] = [
                [
                    'name'        => 'Noto Sans',
                    'liveLink'    => 'https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i',
                    'googleLink'  => '<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i" rel="stylesheet">
',
                    'styles'      => [
                        [
                            'name'    => 'Normal',
                            'style'   => 'normal',
                            'weight'  => '400',
                        ],
                        [
                            'name'    => 'Normal italic',
                            'style'   => 'italic',
                            'weight'  => '400',
                        ],
                        [
                            'name'    => 'Bold',
                            'style'   => 'normal',
                            'weight'  => '700',
                        ],
                        [
                            'name'    => 'Bold italic',
                            'style'   => 'italic',
                            'weight'  => '700',
                        ],
                    ],
                    'cssName'     => 'Noto Sans',
                ],
                [
                    'name'        => 'Noto Serif',
                    'liveLink'    => 'https://fonts.googleapis.com/css?family=Noto+Serif:400,700',
                    'googleLink'  => '<link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700" rel="stylesheet">',
                    'styles'      => [
                        [
                            'name'    => 'Normal',
                            'style'   => 'normal',
                            'weight'  => '400',
                        ],
                        [
                            'name'    => 'Bold',
                            'style'   => 'normal',
                            'weight'  => '700',
                        ],
                    ],
                    'cssName'     => 'Noto Serif',
                ],
                [
                    'name'        => 'Dancing Script',
                    'liveLink'    => 'https://fonts.googleapis.com/css?family=Dancing+Script',
                    'googleLink'  => '<link href="https://fonts.googleapis.com/css?family=Dancing+Script:400,700" rel="stylesheet">',
                    'styles'      => [
                        [
                            'name'    => 'Normal',
                            'style'   => 'normal',
                            'weight'  => '400',
                        ],
                        [
                            'name'    => 'Bold',
                            'style'   => 'normal',
                            'weight'  => '700',
                        ],
                    ],
                    'cssName'     => 'Dancing Script',
                ],
            ];
        }
        $retval['branding'] = $branding;
        return $retval;
    }

    public function typography($project)
    {
        $retval = [];
        if ($project == 1) {

            $project = $this->show($project);
            $retval['project'] = $project;


            //$branding['guidelines'] = [
            $branding['typographyPatterns'] = [
                [
                    'name'  => 'Heading 1',
                    'uses'  => 'Used for Page Titles',
                    'googleLink'  => 'https://fonts.googleapis.com/css?family=Noto+Serif:400,700',
                    'properties' => [
                        'font-family: "Noto Serif", sans-serif;',
                        'font-size: 24px;',
                        'font-weight: 700'
                    ],
                ],
                [
                    'name'  => 'Heading 2',
                    'uses'  => 'Used for Page Subtitles and Carousel Banners',
                    'googleLink'  => 'https://fonts.googleapis.com/css?family=Noto+Serif:400,700',
                    'properties' => [
                        'font-family: "Noto Serif", serif-serif;',
                        'font-size: 18px;',
                        'font-style: italic;',
                        'font-weight: 700'
                    ],
                ]
            ];
            $retval['branding'] = $branding;
            
            return $retval;
        }
    }

    /********
     * TODO move into user controller
     *******/

    /**
     * Retrieves current selected user
     *
     */
    public function currentUser(Request $request) {
        $user = $request->user();

        if ( !empty($user) ) {
            $response = array(
                'success' => true,
                'user'    => $user
            );
            return response()->json($response);
        } else{
            $response = array('success' => false, 'message' => 'No user currently authenticated.');
            return response()->json($response);
        }
    }
}
