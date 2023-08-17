<?php
namespace Bulutly\Laravel\Jobs\V1\Buluts;

use Bulutly\Laravel\Repositories\Contracts\BaseRequest;

class StoreJob extends BaseRequest
{
    public $data, $key;

    public function __construct(array $data, $key = null)
    {
        if (isset($data['project_id'])) $this->data['project_id'] = $data['project_id'];
        $this->data['image_id'] = $data['image_id'];
        if (isset($data['memory'])) $this->data['memory'] = $data['memory'];
        if (isset($data['cpu'])) $this->data['cpu'] = $data['cpu'];
        if (isset($data['name'])) $this->data['name'] = $data['name'];
        if (isset($data['region'])) $this->data['region'] = $data['region'];
        if (isset($data['description'])) $this->data['description'] = $data['description'];
        if (isset($data['auto_scale_cpu'])) $this->data['auto_scale_cpu'] = $data['auto_scale_cpu'];
        if (isset($data['auto_scale_memory'])) $this->data['auto_scale_memory'] = $data['auto_scale_memory'];
        if (isset($data['tags'])) $this->data['tags'] = $data['tags'];
        if (isset($data['startup_script'])) $this->data['startup_script'] = $data['startup_script'];
        $this->key = $key;
    }

    public function handle(){
        try{
            $endpoint = $this->generateApiUrl(config('bulutly.api.endpoints.buluts.store'));
            $req = $this->post($endpoint, $this->data, null, $this->key);
            if ($req->status() === 200 or $req->status() === 201) return $req->json();
            throw new \Exception($req->json()['message']);
        }catch (\Exception $e){
            if (config('bulutly.debug')) throw new \Exception($e->getMessage());
            throw new \Exception('Bulut creation failed');
        }
    }

}