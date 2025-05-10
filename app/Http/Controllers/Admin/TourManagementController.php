<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TourModel;
use App\Models\Home\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class TourManagementController extends Controller
{
    private $tours;

    public function __construct()
    {
        $this->tours = new TourModel();
    }

    public function index()
    {
        $tours = $this->tours->getAllTours();
        return view('admin.tours', compact('tours'));
    }

    public function pageAddTours()
    {
        return view('admin.add-tours');
    }

    public function addTours(Request $request)
    {
        $name = $request->input('name');
        $destination = $request->input('destination');
        $domain = $request->input('domain');
        $quantity = $request->input('number');
        $price_adult = $request->input('price_adult');
        $price_child = $request->input('price_child');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $description = $request->input('description');


        // Chuyển start_date và end_date từ định dạng d/m/Y sang Y-m-d
        $startDate = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');

        // Tính số ngày giữa start_date và end_date
        $days = Carbon::createFromFormat('Y-m-d', $startDate)->diffInDays(Carbon::createFromFormat('Y-m-d', $endDate));

        // Tính số đêm: số ngày - 1
        $nights = $days - 1;

        // Định dạng thời gian theo kiểu "X ngày Y đêm"
        $time = "{$days} ngày {$nights} đêm";


        $dataTours = [
            'title' => $name,
            'duration' => $time,
            'description' => $description,
            'quantity' => $quantity,
            'priceAdult' => $price_adult,
            'priceChild' => $price_child,
            'destination' => $destination,
            'domain' => $domain,
            'availability' => 0,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        // dd($dataTours);

        $createTour = $this->tours->createTours($dataTours);

        // dd($createTour);
        return response()->json([
            'success' => true,
            'message' => 'Tour added successfully!',
            'tourId' => $createTour
        ]);
    }

    public function addImagesTours(Request $request)
    {
        try {
            $image = $request->file('image');
            $tourId = $request->tourId;
            //dd($image);
            // Kiểm tra xem file có hợp lệ không
            if (!$image->isValid()) {
                return response()->json(['success' => false, 'message' => 'Invalid file upload'], 400);
            }

            // Lấy tên gốc của file (không bao gồm đường dẫn)
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

            // Lấy phần mở rộng của file
            $extension = $image->getClientOriginalExtension();

            // Tạo tên file mới: [original_name]_[timestamp].[extension]
            $filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName) . '_' . time() . '.' . $extension;
            // Di chuyển file vào thư mục đích
            $image->storeAs('images', $filename, 'public');
            // Tạo dữ liệu để lưu vào cơ sở dữ liệu
            $dataUpload = [
                'tourId' => $tourId,
                'imgURL' => $filename,
                'description' => $originalName
            ];

            // Lưu thông tin vào cơ sở dữ liệu
            $uploadImage = $this->tours->uploadImages($dataUpload);

            // Kiểm tra kết quả lưu trữ
            if ($uploadImage) {
                return response()->json([
                    'success' => true,
                    'message' => 'Image uploaded successfully',
                    'data' => [
                        'filename' => $filename,
                        'tourId' => $tourId
                    ]
                ], 200);
            }

            return response()->json(['success' => false, 'message' => 'Failed to save image data'], 500);
        } catch (\Exception $e) {
            // Xử lý lỗi bất ngờ
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function addTimeline(Request $request)
    {
        $tourId = $request->input('tourId');

        // Tạo một mảng chứa các timeline
        $timelines = [];

        // Lấy tất cả dữ liệu từ request
        $allData = $request->all();

        // Xác định số lượng ngày dựa vào các field trong request
        $dayCount = 0;
        $continueParsing = true;

        // Duyệt qua để tìm tất cả các ngày
        while ($continueParsing) {
            $titleKey = "title-{$dayCount}";
            $descriptionKey = "description-{$dayCount}";

            // Kiểm tra xem có dữ liệu cho ngày này không
            if ($request->has($titleKey) && $request->has($descriptionKey)) {
                $timeline = [
                    'tourId' => $tourId,
                    'title' => $request->input($titleKey),
                    'description' => $request->input($descriptionKey)
                ];

                $timelines[] = $timeline;
                $dayCount++;
            } else {
                $continueParsing = false;
            }
        }

        // Kiểm tra xem có dữ liệu timeline không
        if (empty($timelines)) {
            return response()->json([
                'success' => false,
                'message' => 'Không có dữ liệu lộ trình được gửi!'
            ]);
        }

        // Lưu các timeline vào database
        foreach ($timelines as $timeline) {
            $this->tours->addTimeLine($timeline);
        }

        // Cập nhật trạng thái của tour
        $dataUpdate = [
            'availability' => 1
        ];

        $updateAvailability = $this->tours->updateTour($tourId, $dataUpdate);

        // Trả về phản hồi thành công
        return response()->json([
            'success' => true,
            'message' => 'Thêm lộ trình tour thành công!',
            'timelines' => $timelines
        ]);
    }

    public function deleteTour(Request $request)
    {
        $tourId = $request->tourId;
        $this->tours->deleteTour($tourId);
        $this->tours->deleteTimeline($tourId);
        $this->tours->deleteImage($tourId);
        return response()->json([
            'success' => true,
            'message' => 'Xóa tour thành công!',
        ]);
    }
}
