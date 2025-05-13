@extends('layoutAdmin.master')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Danh sách booking</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0 fw-bold">Quản lý liên hệ khách hàng</h5>
                                <small class="text-muted">Tại đây, bạn có thể xem và quản lý các thông tin liên lạc từ khách
                                    hàng, trả lời câu hỏi và theo dõi các trao đổi để cải thiện dịch vụ.</small>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#contact-card-body">
                                    <i class="fa fa-chevron-up"></i>
                                </button>
                                <button class="btn btn-sm btn-light" type="button"
                                    onclick="$(this).closest('.card').remove();">
                                    <i class="fa fa-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body collapse show" id="contact-card-body">
                            <div class="row">
                                <!-- Danh sách liên hệ -->
                                <div class="col-md-4 mb-3">
                                    <div class="list-group" style="max-height: 220px; overflow-y: auto;">
                                        <div class="list-group-item bg-success text-white fw-bold text-center">
                                            Liên hệ khách hàng
                                        </div>
                                        @foreach ($contacts as $contact)
                                            <a href="javascript:void(0)"
                                                class="list-group-item list-group-item-action contact-item"
                                                data-name="{{ $contact->fullName }}" data-email="{{ $contact->email }}"
                                                data-message="{{ $contact->message }}"
                                                data-contactid="{{ $contact->contactId }}">
                                                <div class="align-items-center">
                                                    <div>
                                                        <i class="fa fa-user-circle me-2"></i> 
                                                        <span class="fw-bold">{{ $contact->fullName }}</span>
                                                        <small class="text-muted d-block">{{ $contact->phoneNumber }}</small>
                                                    </div>
                                                    <span>{{ \Illuminate\Support\Str::limit($contact->message, 20) }}</span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Nội dung liên hệ -->
                                <div class="col-md-8">
                                    <div class="card border" id="contact-detail-card" style="display:none">
                                        <div class="card-header bg-light">
                                            <div class="">
                                                <div>
                                                    <strong id="contact-name"></strong>
                                                    <span class="text-muted" id="contact-email"></span>
                                                </div>
                                                <span class="badge bg-info" id="contact-id"></span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="contact-message" class="mb-3 text-break"></div>
                                            <div class="btn-group">
                                                <button id="compose" class="btn btn-sm btn-primary" type="button">
                                                    <i class="fa fa-reply"></i> Trả lời
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" type="button"
                                                    id="delete-contact">
                                                    <i class="fa fa-trash"></i> Xóa
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Form phản hồi liên hệ (ẩn mặc định) -->
    <div class="compose col-md-6" id="compose-contact"
        style="background-color: #ddd; display:none; position:fixed; bottom:10%; right:0%; z-index:1050;">
        <div class="compose-header d-flex justify-content-between align-items-center bg-primary text-white p-2">
            <span>Phản hồi liên hệ</span>
            <button type="button" class="close compose-close btn btn-sm btn-light">
                <span>&times;</span>
            </button>
        </div>
        <div class="compose-body p-3">
            <div id="editor-contact" class="editor-wrapper" contenteditable="true" style="min-height:120px; border:1px solid #ddd; border-radius:4px; padding:8px;"></div>
        </div>
        <div class="compose-footer p-2 text-end">
            <button class="send-reply-contact btn btn-sm btn-success" type="button"
                data-url="{{ route('admin.reply-contact') }}">Gửi</button>
        </div>
    </div>
@endsection
