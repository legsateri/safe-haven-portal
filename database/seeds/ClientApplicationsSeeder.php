<?php

use Illuminate\Database\Seeder;

use App\ObjectType;
use App\Organisation;
use App\Application;
use App\ApplicationPet;
use App\Client;
use App\Pet;
use App\Phone;
use App\Address;
use App\User;

class ClientApplicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get organisation type id for advocate
        $advocateTypeOrg = ObjectType::where([
                            ['type', '=', 'organisation'],
                            ['value', '=', 'advocate']
                        ])->first();
        
        // get list of advocate organisations
        $organisations = Organisation::where('org_type_id', $advocateTypeOrg->id)->get();

        // demo data for applications, clients and pets
        $demoEntries = [
            [
                'client-first-name' => 'Noelyn',
                'client-last-name' => 'Impett',
                'client-email' => 'nimpett0@tripadvisor.com',
                'pet-type' => 'dog',
                'pet-name' => 'Duke',
                'pet-breed' => 'no',
                'pet-weight' => 40,
                'pet-age' => 8,
                'pet-description' => 'no',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => 'no',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => 'no',
                'pet-relevant-info' => 'no',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '5717851256',
                'client-state' => 'Virginia',
                'client-city' => 'vienna',
                'client-address' => '12758 Farragut Terrace',
                'client-zip' => '185369',
            ],
            [
                'client-first-name' => 'Thebault',
                'client-last-name' => 'Wattingham',
                'client-email' => 'twattingham1@flavors.me',
                'pet-type' => 'cat',
                'pet-name' => 'Mike',
                'pet-breed' => 'Persian cat',
                'pet-weight' => 6,
                'pet-age' => 9,
                'pet-description' => 'no',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => 'no',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => 'no',
                'pet-relevant-info' => 'no',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => 'no',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '9516948666',
                'client-state' => 'California',
                'client-city' => 'Moreno Valley',
                'client-address' => '02 Bonner Place',
                'client-zip' => '111555',
            ],
            [
                'client-first-name' => 'Claresta',
                'client-last-name' => 'Brahams',
                'client-email' => 'cbrahams2@usda.gov',
                'pet-type' => 'dog',
                'pet-name' => 'Doggy',
                'pet-breed' => 'mix',
                'pet-weight' => 15,
                'pet-age' => 2,
                'pet-description' => 'no',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => 'no',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '8477218270',
                'client-state' => 'Illinois',
                'client-city' => 'Palatine',
                'client-address' => '21 Norway Maple Parkway',
                'client-zip' => '123456',
            ],
            [
                'client-first-name' => 'Andrea',
                'client-last-name' => 'Andrasch',
                'client-email' => 'candrasch3@wix.com',
                'pet-type' => 'dog',
                'pet-name' => 'Blah',
                'pet-breed' => '-',
                'pet-weight' => 8,
                'pet-age' => 10,
                'pet-description' => '-',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => '-',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '8323206108',
                'client-state' => 'Texas',
                'client-city' => 'Houston',
                'client-address' => '98 Buena Vista Trail',
                'client-zip' => '3698521',
            ],
            [
                'client-first-name' => 'Wilie',
                'client-last-name' => 'Titterton',
                'client-email' => 'wtitterton4@a8.net',
                'pet-type' => 'dog',
                'pet-name' => 'Will',
                'pet-breed' => '-',
                'pet-weight' => 12.3,
                'pet-age' => 11,
                'pet-description' => '-',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => '-',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '2695178991',
                'client-state' => 'Michigan',
                'client-city' => 'Kalamazoo',
                'client-address' => '892 Morning Lane',
                'client-zip' => '741258',
            ],
            [
                'client-first-name' => 'Inez',
                'client-last-name' => 'Hamlen',
                'client-email' => 'ihamlen5@dagondesign.com',
                'pet-type' => 'dog',
                'pet-name' => 'Ini',
                'pet-breed' => '-',
                'pet-weight' => 3,
                'pet-age' => 1,
                'pet-description' => '-',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => '-',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '4401926432',
                'client-state' => 'Ohio',
                'client-city' => 'Cleveland',
                'client-address' => '25730 Bay Place',
                'client-zip' => '789654',
            ],
            [
                'client-first-name' => 'Eberhard',
                'client-last-name' => 'Tander',
                'client-email' => 'etander6@thetimes.co.uk',
                'pet-type' => 'cat',
                'pet-name' => 'Cat',
                'pet-breed' => '-',
                'pet-weight' => 5.5,
                'pet-age' => 12,
                'pet-description' => '-',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => '-',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '5042117188',
                'client-state' => 'Louisiana',
                'client-city' => 'New Orleans',
                'client-address' => '1823 Quincy Way',
                'client-zip' => '789656',
            ],
            [
                'client-first-name' => 'Pamella',
                'client-last-name' => 'Lyst',
                'client-email' => 'plyst7@tinypic.com',
                'pet-type' => 'cat',
                'pet-name' => 'Pam',
                'pet-breed' => '-',
                'pet-weight' => 4,
                'pet-age' => 3,
                'pet-description' => '-',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => '-',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '6015673283',
                'client-state' => 'Mississippi',
                'client-city' => 'Jackson',
                'client-address' => '4 Riverside Plaza',
                'client-zip' => '258963',
            ],
            [
                'client-first-name' => 'Conrad',
                'client-last-name' => 'Rodolico',
                'client-email' => 'crodolico8@statcounter.com',
                'pet-type' => 'dog',
                'pet-name' => 'Doggy',
                'pet-breed' => '-',
                'pet-weight' => 12,
                'pet-age' => 6,
                'pet-description' => '-',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => '-',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '4106462020',
                'client-state' => 'Maryland',
                'client-city' => 'Baltimore',
                'client-address' => '8 Paget Trail',
                'client-zip' => '785244',
            ],
            [
                'client-first-name' => 'Norah',
                'client-last-name' => 'Gives',
                'client-email' => 'ngives9@smugmug.com',
                'pet-type' => 'dog',
                'pet-name' => 'King',
                'pet-breed' => '-',
                'pet-weight' => 45,
                'pet-age' => 9,
                'pet-description' => '-',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => '-',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '8134612728',
                'client-state' => 'Florida',
                'client-city' => 'Tampa',
                'client-address' => '2184 Main Hill',
                'client-zip' => '456987',
            ],
            [
                'client-first-name' => 'Shelby',
                'client-last-name' => 'Tull',
                'client-email' => 'stulla@wufoo.com',
                'pet-type' => 'dog',
                'pet-name' => 'Shell',
                'pet-breed' => '-',
                'pet-weight' => 8,
                'pet-age' => 11,
                'pet-description' => '-',
                'pet-microchipped' => 1,
                'pet-vaccinations' => 1,
                'pet-spayed' => 1,
                'pet-spayed-object' => 0,
                'pet-dietary-needs' => '-',
                'pet-veterinary-needs' => 'no',
                'pet-behavior' => '-',
                'pet-relevant-info' => '-',
                'police-involved' => 1,
                'client-protective-order' => 1,
                'abuser-details' => '-',
                'pet-abuser-access' => 0,
                'pet-how-long' => 25,
                'pet-protective-order-covered' => 1,
                'pet-client-paperwork' => 1,
                'pet-abuser-paperwork' => 0,
                'pet-boarding-options' => 1,
                'client-phone-number-type' => 'mobile',
                'client-phone-number' => '5055801538',
                'client-state' => 'New Mexico',
                'client-city' => 'Las Cruces',
                'client-address' => '9 Truax Center',
                'client-zip' => '789632',
            ],
            // [
            //     'client-first-name' => '',
            //     'client-last-name' => '',
            //     'client-email' => '',
            //     'pet-type' => '',
            //     'pet-name' => '',
            //     'pet-breed' => '-',
            //     'pet-weight' => '',
            //     'pet-age' => '',
            //     'pet-description' => '-',
            //     'pet-microchipped' => 1,
            //     'pet-vaccinations' => 1,
            //     'pet-spayed' => 1,
            //     'pet-spayed-object' => 0,
            //     'pet-dietary-needs' => '-',
            //     'pet-veterinary-needs' => 'no',
            //     'pet-behavior' => '-',
            //     'pet-relevant-info' => '-',
            //     'police-involved' => 1,
            //     'client-protective-order' => 1,
            //     'abuser-details' => '-',
            //     'pet-abuser-access' => 0,
            //     'pet-how-long' => 25,
            //     'pet-protective-order-covered' => 1,
            //     'pet-client-paperwork' => 1,
            //     'pet-abuser-paperwork' => 0,
            //     'pet-boarding-options' => 1,
            //     'client-phone-number-type' => 'mobile',
            //     'client-phone-number' => '',
            //     'client-state' => '',
            //     'client-city' => '',
            //     'client-address' => '',
            //     'client-zip' => '',
            // ],
            // [
            //     'client-first-name' => '',
            //     'client-last-name' => '',
            //     'client-email' => '',
            //     'pet-type' => '',
            //     'pet-name' => '',
            //     'pet-breed' => '-',
            //     'pet-weight' => '',
            //     'pet-age' => '',
            //     'pet-description' => '-',
            //     'pet-microchipped' => 1,
            //     'pet-vaccinations' => 1,
            //     'pet-spayed' => 1,
            //     'pet-spayed-object' => 0,
            //     'pet-dietary-needs' => '-',
            //     'pet-veterinary-needs' => 'no',
            //     'pet-behavior' => '-',
            //     'pet-relevant-info' => '-',
            //     'police-involved' => 1,
            //     'client-protective-order' => 1,
            //     'abuser-details' => '-',
            //     'pet-abuser-access' => 0,
            //     'pet-how-long' => 25,
            //     'pet-protective-order-covered' => 1,
            //     'pet-client-paperwork' => 1,
            //     'pet-abuser-paperwork' => 0,
            //     'pet-boarding-options' => 1,
            //     'client-phone-number-type' => 'mobile',
            //     'client-phone-number' => '',
            //     'client-state' => '',
            //     'client-city' => '',
            //     'client-address' => '',
            //     'client-zip' => '',
            // ],
            
        ];

        
        foreach ($organisations as $organisation) 
        {    
            // get advocate from current organisation
            $user = User::where('organisation_id', $organisation->id)->first();
            
            // create client in need
            foreach ($demoEntries as $entry) 
            {
                $petType = DB::table('object_types')
                        ->where([
                            ['type', '=', 'pet'],
                            ['value', '=', $entry['pet-type']]
                        ])
                        ->first();
                
                // new client
                $client = new Client();
                $client->organisation_id = $organisation->id;
                $client->first_name = $entry['client-first-name'];
                $client->last_name = $entry['client-last-name'];
                $client->email = $entry['client-email'];
                $client->best_way_to_reach = "email";
                $client->pets_count = 1;
                $client->slug = str_slug($entry['client-first-name'] . ' ' . $entry['client-last-name'] , '-');
                $client->save();

                // new pet
                $pet = new Pet();
                $pet->client_id = $client->id;
                $pet->organisation_id = $organisation->id;
                $pet->pet_type_id = $petType->id;
                $pet->name = $entry['pet-name'];
                $pet->breed = $entry['pet-breed'];
                $pet->weight = $entry['pet-weight'];
                $pet->age = $entry['pet-age'];
                $pet->description = $entry['pet-description'];
                $pet->microchipped = $entry['pet-microchipped'];
                $pet->vaccinations = $entry['pet-vaccinations'];
                $pet->sprayed = $entry['pet-spayed'];
                $pet->objection_to_spray = $entry['pet-spayed-object'];
                $pet->dietary_needs = $entry['pet-dietary-needs'];
                $pet->vet_needs = $entry['pet-veterinary-needs'];
                $pet->temperament = $entry['pet-behavior'];
                $pet->aditional_info = $entry['pet-relevant-info'];
                $pet->slug = str_slug($entry['pet-name'], '-');
                $pet->save();

                // new client application
                $application = new Application();
                $application->client_id = $client->id;
                $application->organisation_id = $organisation->id;
                $application->created_by_advocate_id = $user->id;
                $application->police_involved = $entry['police-involved'];
                $application->protective_order = $entry['client-protective-order'];
                $application->abuser_notes = $entry['abuser-details'];
                $application->save();

                // new pet application
                $application_pet = new ApplicationPet();
                $application_pet->application_id = $application->id;
                $application_pet->pet_id = $pet->id;
                $application_pet->client_id = $client->id;
                $application_pet->organisation_id = $organisation->id;
                $application_pet->created_by_advocate_id = $user->id;
                $application_pet->abuser_visiting_access = $entry['pet-abuser-access'];
                $application_pet->estimated_lenght_of_housing = $entry['pet-how-long'];
                $application_pet->pet_protective_order = $entry['pet-protective-order-covered'];
                $application_pet->client_legal_owner_of_pet = $entry['pet-client-paperwork'];
                $application_pet->abuser_legal_owner_of_pet = $entry['pet-abuser-paperwork'];
                $application_pet->explored_boarding_options = $entry['pet-boarding-options'];
                $application_pet->save();

                // get phone type
                $phone_type = ObjectType::where([
                    ['type', '=', 'phone'],
                    ['value', '=', $entry['client-phone-number-type']]
                ])->first();

                // save client phone number
                $phone = new Phone();
                $phone->entity_type = 'client';
                $phone->entity_id = $client->id;
                $phone->phone_type_id = $phone_type->id;
                $phone->number = $entry['client-phone-number'];
                $phone->save();

                // save client address
                $address = new Address();
                $address->entity_type = 'client';
                $address->entity_id = $client->id;
                $address->state = $entry['client-state'];
                $address->city = $entry['client-city'];
                $address->street = $entry['client-address'];
                $address->zip_code = $entry['client-zip'];
                $address->save();

            } // end foreach entry


        } // end foreach organisation


    }
}
