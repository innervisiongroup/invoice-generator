<?php 

class SettingsTableSeeder extends Seeder {

    public function run()
    {
        Setting::truncate();

        Setting::create(array(
            'app_name'     => 'Invoice Generator',
            'main_logo' => '//assets.innervisiongroup.com/img/ivg-logo/svg/logo_hcnegatif.svg',
            'favicon' => '//assets.innervisiongroup.com/img/fav/icon.png',
            'company_name' => 'Company Name',
            'company_street_address' => '25, St. Address',
            'company_zip_code' => '12345',
            'company_city' => 'Paris',
            'company_country' => 'France',
            'company_phone_number' => '+33 6 123 456',
        ));
    }
}