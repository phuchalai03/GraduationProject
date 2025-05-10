@extends('layoutAdmin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Danh sách tour</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Tours</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Tên
                                            </th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Thời
                                                gian</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Mô
                                                tả</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Số
                                                lượng</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Giá
                                                người lớn</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Giá
                                                trẻ em</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Địa
                                                điểm</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Ngày
                                                bắt đầu</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px">Ngày
                                                kết thúc</th>
                                            <th style="text-transform:none; letter-spacing:0; padding:7px 30px 7px 7px"
                                                style="width: 5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tours as $tour)
                                            <tr>
                                                <td style="padding: 7px">{{ $tour->title }}</td>
                                                <td style="padding: 7px">{{ $tour->duration }}</td>
                                                <td style="padding: 7px">{{ $tour->description }}</td>
                                                <td style="padding: 7px">{{ $tour->quantity }}</td>
                                                <td style="padding: 7px">{{ number_format($tour->priceAdult, 0, ',', '.') }}
                                                </td>
                                                <td style="padding: 7px">{{ number_format($tour->priceChild, 0, ',', '.') }}
                                                </td>
                                                <td style="padding: 7px">{{ $tour->destination }}</td>
                                                <td style="padding: 7px">{{ date('d-m-Y', strtotime($tour->startDate)) }}
                                                </td>
                                                <td style="padding: 7px">{{ date('d-m-Y', strtotime($tour->endDate)) }}</td>
                                                <td style="padding: 7px">
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <div class="form-button-action">
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}">
                                                            <button type="button" data-id="{{ $tour->tourId }}"
                                                                data-bs-toggle="tooltip" title="Xóa"
                                                                class="btn btn-link btn-danger btn-delete"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
