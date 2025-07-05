<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DashboardModel extends Model
{
    use HasFactory;

    public function getSummary()
    {
        $tourWorking = DB::table('tours')
            ->count();
        $countBooking =DB::table('bookings')
            ->where('bookingStatus', '!=', 'c')
            ->count();
        $totalAmount = DB::table('checkouts')
            ->where('paymentStatus', 'y')
            ->sum('amount');

        // Trả về mảng chứa các dữ liệu tổng hợp
        return [
            'tourWorking' => $tourWorking,
            'countBooking' => $countBooking,
            'totalAmount' => $totalAmount,
        ];
    }

    public function getValueDomain()
    {
        // Lấy số lượng tours cho mỗi miền (b, t, n)
        return DB::table('tours')
            ->select(DB::raw('domain, COUNT(*) as count'))
            ->whereIn('domain', ['b', 't', 'n'])  // Chỉ lấy các miền có domain b, t, n
            ->groupBy('domain')  // Nhóm theo domain
            ->get()
            ->pluck('count', 'domain');  // Trả về mảng với key là domain và value là count
    }

    public function getValuePayment()
    {
        return DB::table('checkouts')
            ->select('paymentMethod', DB::raw('COUNT(*) as count'))
            ->groupBy('paymentMethod')
            ->get()
            ->toArray();
    }

    public function getMostTourBooked()
    {
        return DB::table('tours')
            ->join('bookings', 'tours.tourId', '=', 'bookings.tourId')
            ->select('tours.tourId', 'tours.title', 'tours.quantity', DB::raw('SUM(bookings.numAdults + bookings.numChildren) as booked_quantity'))
            ->groupBy('tours.tourId', 'tours.quantity', 'tours.title')
            ->orderByDesc(DB::raw('SUM(bookings.numAdults + bookings.numChildren)')) // Sắp xếp theo số lượng đặt tour giảm dần
            ->take(5) // Lấy 3 tour có số lượng đặt cao nhất
            ->get();
    }

    public function getNewBooking()
    {
        return DB::table('bookings')
            ->join('tours', 'bookings.tourId', '=', 'tours.tourId')
            ->where('bookings.bookingStatus', 'b')
            ->orderByDesc('bookings.bookingDate')
            ->select('bookings.*', 'tours.title as tour_name') // Chọn tất cả các cột từ tbl_booking và thêm tên tour từ tbl_tours
            ->take(3)
            ->get();

    }

    public function getHistoryTransaction()
    {
        return DB::table('checkouts')
            ->join('bookings', 'checkouts.bookingId', '=', 'bookings.bookingId')
            ->join('tours', 'bookings.tourId', '=', 'tours.tourId')
            ->where('checkouts.paymentStatus', 'y')
            ->orderByDesc('checkouts.created_at')
            ->select('checkouts.*', 'bookings.*', 'tours.title as tour_name') // Chọn tất cả các cột từ tbl_checkout và thêm tên tour từ tbl_tours
            ->take(10)
            ->get();
    }

    public function getRevenuePerMonth()
    {
        $monthlyRevenue = DB::table('bookings')
            ->select(DB::raw('MONTH(bookingDate) as month, SUM(totalPrice) as revenue'))
            ->where('bookingStatus', 'y')
            ->groupBy(DB::raw('MONTH(bookingDate)'))
            ->orderBy('month', 'asc')
            ->get();

        // Chuẩn bị mảng doanh thu với 12 tháng
        $revenueData = array_fill(0, 12, 0);  // Mảng chứa doanh thu cho 12 tháng

        // Gán doanh thu cho từng tháng
        foreach ($monthlyRevenue as $data) {
                $revenueData[$data->month - 1] = $data->revenue;  // Gán doanh thu cho tháng tương ứng
        }

        return $revenueData;
    }

}
