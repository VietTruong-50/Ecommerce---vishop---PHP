<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider){
        $this->slider = $slider;
    }

    public function index(){
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create(){
        return view('admin.slider.add');
    }

    public function store(SliderAddRequest $request){
        try{
            $data = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImageSlides = $this->storageTraitUpload($request,'image_path', 'slider');

            if(!empty($dataImageSlides)){
                $data['image_name'] = $dataImageSlides['file_name'];
                $data['image_path'] = $dataImageSlides['file_path'];
            }

            $this->slider->create($data);
            return redirect()->route('sliders.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }

    public function edit($id){
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderAddRequest $request, $id){
        try{
            $data = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImageSlides = $this->storageTraitUpload($request,'image_path', 'slider');

            if(!empty($dataImageSlides)){
                $data['image_name'] = $dataImageSlides['file_name'];
                $data['image_path'] = $dataImageSlides['file_path'];
            }

            $this->slider->find($id)->update($data);
            return redirect()->route('sliders.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
        }
    }

    public function delete($id){
        try{
            $this->slider->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        }catch (\Exception $exception){
            Log::error('Message' . $exception->getMessage() . 'Line' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
