@extends('Admin.layout')

@section('content')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>LỊCH SỬ GIAO DỊCH</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-block">

                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                            <th>Người nạp</th>
                                                <th> Người duyệt</th>
                                                <th>Loại giao dịch</th>
                                                <th>Số xu</th>
                                                <th>Trạng thái</th>
                                                <th>Thời gian giao dịch</th>
                                                <th>Quản lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->user->username }}</td>
                                                <td>{{ $transaction->admin_id }}</td>
                                                <td>  {{ $transaction->title }} </td>
                                                <td>{{ $transaction->quantity_coin }}</td>
                                                <td>  {{ $transaction->status }} </td>
                                                <td>{{$transaction->time_date}}</td>
                                                <td>
                                                    @if ($transaction->title == 'Rút Xu')
                                                    <div style="width: 90px;" class="btn-group btn-group-sm">
                                                    <a  href ="{{ url('dashboard/transaction/detail/' . $transaction['requestTran_id']) }}"  style="margin: 4px;" class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                        <span class="icofont icofont-ui-edit"></span>
                                                        @endif
                                                    </a>
                                                </td>
                                                <td hidden>{{$transaction->requestTran_id}}</td>
                                            </tr>
                                              @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>


@endsection()

@yield('js')
<script>
    function delete_account(id, name) {
        const is_confirm = confirm(`Bạn muốn xóa tài khoản "${name}" ?`);
        if (!is_confirm) {
            return
        }

        const data = new FormData();
        data.append('id', id);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch('<?= url('dashboard/admin/delete') ?>', requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    msgbox_success(result.message)
                    document.getElementById(`menu-${id}`).remove()
                    return
                }

                const error = result.result.error;
                if (error) {
                    msgbox_error(error)
                    return
                }

            })
            .catch(error => msgbox_error(error));
    }
</script>

