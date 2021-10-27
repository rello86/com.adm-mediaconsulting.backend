<?php

    namespace Rello86\AdmMediaConsulting\Console\Commands;

    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Http;
    use Rello86\AdmMediaConsulting\Models\People;
    use Rello86\AdmMediaConsulting\Models\PeoplePlanet;
    use Rello86\AdmMediaConsulting\Models\Planet;

    class PeoplesPlanetsCommand extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'rello86:pp';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Getting Peoples and Planets from • GET https://swapi.dev/api/people';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return int
         */
        public function handle()
        {

            DB::transaction(function () {
                $parsedAll = false;
                $page = 'https://swapi.dev/api/people/';
                while (!$parsedAll) {
                    // Get HTTP response
                    $response = Http::get($page);
                    $this->warn('GET https://swapi.dev/api/people/ ....');
                    // If HTTP 200
                    if ($response->successful()) {
                        $this->info('SUCCESS https://swapi.dev/api/people/');
                        // Get the json object response
                        //print_r($response->json());
                        $responseJson = $response->json();
                        if ($responseJson['next'] === NULL) {
                            $parsedAll = true;
                        } else {
                            $page = $responseJson['next'];
                        }
                        $this->warn('SYNCING ' . count($responseJson['results']) . ' records');
                        foreach ($responseJson['results'] as $people) {

                            $_people = People::updateOrCreate(
                                ['name' => $people['name']],
                                [
                                    'name' => $people['name'],
                                    'height' => $people['height'],
                                    'mass' => $people['mass'],
                                    'hair_color' => $people['hair_color'],
                                    'skin_color' => $people['skin_color'],
                                    'eye_color' => $people['eye_color'],
                                    'birth_year' => $people['birth_year'],
                                    'gender' => $people['gender'],
                                    'created_at' => $people['created'],
                                    'updated_at' => $people['edited'],
                                    'url' => $people['url'],
                                ]
                            );

                            $responsePlanet = Http::get($people['homeworld']);
                            $this->warn('GET ' . $people['homeworld'] . ' ....');
                            // If HTTP 200
                            if ($responsePlanet->successful()) {
                                $this->info('SUCCESS ' . $people['homeworld']);
                                // Get the json object response
                                //print_r($responsePlanet->json());
                                $responsePlanetJson = $responsePlanet->json();

                                $_planet = Planet::updateOrCreate(
                                    ['name' => $responsePlanetJson['name']],
                                    [
                                        'name' => $responsePlanetJson['name'],
                                        'rotation_period' => ($responsePlanetJson['rotation_period'] !== 'unknown') ? $responsePlanetJson['rotation_period'] : NULL,
                                        'orbital_period' => ($responsePlanetJson['orbital_period'] !== 'unknown') ? $responsePlanetJson['orbital_period'] : NULL,
                                        'diameter' => ($responsePlanetJson['diameter'] !== 'unknown') ? $responsePlanetJson['diameter'] : NULL,
                                        'climate' => $responsePlanetJson['climate'],
                                        'gravity' => $responsePlanetJson['gravity'],
                                        'terrain' => $responsePlanetJson['terrain'],
                                        'surface_water' => ($responsePlanetJson['surface_water'] !== 'unknown') ? $responsePlanetJson['surface_water'] : NULL,
                                        'created_at' => $responsePlanetJson['created'],
                                        'updated_at' => $responsePlanetJson['edited'],
                                        'population' => ($responsePlanetJson['population'] !== 'unknown') ? $responsePlanetJson['population'] : NULL,
                                        'url' => $responsePlanetJson['url'],
                                    ]
                                );

                                if ($_people && $_planet) {
                                    $people_planet = new PeoplePlanet();
                                    $people_planet->people_id = $_people->id;
                                    $people_planet->planet_id = $_planet->id;
                                    $people_planet->save();
                                }

                            }
                        }
                        $this->info('SUCCESS ' . count($responseJson['results']) . ' records has been addedd to PEOPLES table');
                    } else {
                        $this->error('FAILED');
                    }
                }

            });


            return Command::SUCCESS;
        }
    }
