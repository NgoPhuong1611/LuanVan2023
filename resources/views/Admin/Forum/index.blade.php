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
                                    <h4>Forum</h4>
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
                                                <th>Id</th>
                                                <th>User</th>
                                                <th>Admin</th>
                                                <th >detail</th>
                                                <th>time_date</th>
                                                <th >Quản lý</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($forums) || !empty($forums)) : ?>
                                            <?php foreach ($forums as $item) : ?>
                                            <tr>
                                                <td><?= $item['id'] ?></td>
                                                <td><?= $item['username'] ?></td>
                                                <td><?= $item['admin_username'] ?></td>
                                                <td style=" width: 40%; max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                                    @if(!empty($item['title']))
                                                        <?= $item['title'] ?>
                                                    @else
                                                        <?= $item['detail'] ?>
                                                    @endif
                                                </td>
                                                    <td><?= $item['time_date'] ?></td>
                                                    <td>
                                                    <div style="width: 90px;" class="btn-group btn-group-sm">
                                                        <!-- <a href ="<?= url('dashboard/user/edit/'.$item['id']) ?>"  style="margin: 4px;"  class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                            <span class="icofont icofont-ui-edit"></span>
                                                        </a> -->
                                                         <a href ="<?= url('dashboard/forum') ?>"  style="margin: 4px;"  class="tabledit-edit-button btn btn-primary waves-effect waves-light">
                                                            <span class="icofont icofont-ui-edit"></span>
                                                        </a>
                                                        <a href ="<?= url('dashboard/forum/destroy/'.$item['id']) ?>" style="margin: 4px;" onclick="delete_account()" class="tabledit-delete-button btn btn-danger waves-effect waves-light">
                                                            <span class="icofont icofont-ui-delete"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            <?php endif ?>
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

