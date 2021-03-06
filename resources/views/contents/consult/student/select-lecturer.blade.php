@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Konsultasi</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('consult.student.list') }}">Konsultasi</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Dosen/Konselor
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="alert alert-primary alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bx-error-circle"></i>
        <span>
            Aplikasi sangat merahasiakan data Anda, Dosen/Konselor tidak dapat mengetahui data diri Anda.
        </span>
    </div>
</div>
<div class="content-body">
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Pilih Dosen/Konselor</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <p>Klik pada nama dosen/konselor untuk memilih, kemudian pilih jadwal ketersediaan dosen/konselor yang diinginkan.</p>
                <div class="table-responsive">
                    <table class="table mb-0 table-hover" id="lecturer-table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>NIP</th>
                                <th>JURUSAN</th>
                                <th>FAKULTAS</th>                                
                                <th>AKSI</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="col-12 d-flex justify-content-start mt-1">
                    <a href="{{ route('consult.student.list') }}" class="btn btn-light-secondary mr-1 mb-1">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="student-detail" tabindex="-1" role="dialog" aria-labelledby="studentDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title white">Rincian Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let lecture_table;

        $(function () {
            lecture_table = $('#lecturer-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('consult.student.data.lecturer') }}',
                    data: function (params) {
                        
                    }
                },
                order: [
                    [6, 'desc']
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0, 5]
                    },
                    {
                        className: 'text-center',
                        targets: [5]
                    },
                    {
                        visible: false,
                        targets: [6, 0]
                    }
                ],
                columns: [{
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'lecturer.nip',
                        name: 'lecturer.nip'
                    },                                                        
                    {
                        data: 'lecturer.major.name',
                        name: 'lecturer.major.name'
                    },
                    {
                        data: 'lecturer.major.faculty.name',
                        name: 'lecturer.major.faculty.name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]      
            });
        });

        const modal_detail = $('#student-detail');

        const showDetail = (id) => {
            $.get("{{ route('consult.student.detail.lecturer') }}", {
                id
            }).done((result) => {
                modal_detail.find('.modal-body').html(result);
                modal_detail.modal('show');
            });
        }

        const selectSchedule = (id) => {
            if (modal_detail.find('input[name=is_meeting]').is(':checked')) {
                let is_meeting = modal_detail.find('input[name=is_meeting]:checked').val();

                let url = `{{ route('consult.student.select.schedule') }}?id=${id}&is_meeting=${is_meeting}`;

                window.location = url;
                
            } else {
                toastr.error('Silahkan pilih metode konsultasi', 'Gagal');
            }
        }
    </script>
@endpush