<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingAddRequest;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $settings = $this->setting->latest()->paginate(5);
        return view('admin.setting.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.setting.add');
    }

    public function store(SettingAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->setting->create([
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
                'type_setting' => $request->type
            ]);
            DB::commit();
            return redirect()->route('setting.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return 'Error';
        }

    }

    public function edit($id)
    {
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update($id, SettingAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->setting->find($id)->update([
                'config_key' => $request->config_key,
                'config_value' => $request->config_value
            ]);
            DB::commit();
            return redirect()->route('setting.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return 'Error';
        }
    }

    public function delete($id)
    {
        try {
            $this->setting->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
