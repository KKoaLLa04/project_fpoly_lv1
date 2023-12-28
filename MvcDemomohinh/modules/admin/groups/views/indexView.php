<?php get_header('', 'Nhóm người dùng') ?>
<div class="container">
    <h1>Nhóm người dùng</h1>
    <a href="?role=admin&mod=groups&action=create" class="btn btn-primary">Thêm nhóm mới <i class="fa fa-plus"></i></a>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="3%">#</th>
                <th>Tên nhóm</th>
                <th width="10%">Phân quyền</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data['groups'])) :
                foreach ($data['groups'] as $key => $item) : ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $item['name'] ?></td>
                <td><a href="?role=admin&mod=groups&action=permission&id=<?= $item['id'] ?>"
                        class="btn btn-primary">Phân quyền</a></td>
                <td><a href="#" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                <td><a href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php endforeach;
            endif; ?>
        </tbody>
    </table>
</div>
<?php get_footer() ?>