<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\AgentTranslation;
use App\Agent;
use App\Common;

class AgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agents = ['Bùi Mỹ Vân'
        , 'Bùi Thanh Hà'];
        $emails = ['vanland09a@gmail.com'
        , 'buithanhha@gmail.com'];
        $mobiles = ['0932622017'
        , '01654477039'];
        $thumnails = ['/frontend/images1/Agents/BuiMyVan.png'
        , '/frontend/images1/Agents/BuiThanhHa.png'];
        foreach ($agents as $key => $value) 
        {
	        $entry = Agent::create([
                'email' => $emails[$key],
                'mobile' => $mobiles[$key],
                'thumnail' => $thumnails[$key],
                'priority' => $key,
				'active' => 1,
				'created_by' => 1,
				'updated_by' => 1
			]);
			$entry->translations()->save( new AgentTranslation ([
				'agent_id' => $entry->id,
				'locale' => 'vi',
				'name' => $value,
				'summary' => $value,
				'meta_description' => $value . ' - ' . $mobiles[$key] . ' - chuyên viên môi giới Landing',
				'meta_keywords' => $value,
			]));
        }
    }
}
