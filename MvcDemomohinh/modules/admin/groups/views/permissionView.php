<?php
get_header('', 'Phân quyền nhóm người dùng');

$permissionJson = $data['groups']['permission'];
$permissionArr = json_decode($permissionJson, true);
?>
<div class="container">
    <h1>Phân quyền nhóm người dùng - <b><?= !empty($data['groups']) ? $data['groups']['name'] : false ?></b></h1>
    <a href="?role=admin&mod=groups" class="btn btn-success">Quay lại</a>
    <hr>
    <form action="" method="post">
        <table class="table table-bordered permission_obj">
            <thead>
                <tr>
                    <th width="3%">#</th>
                    <th width="10%">Modules</th>
                    <th width="20%">Tiêu đề</th>
                    <th>Quyền</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['modules'])) :
                    foreach ($data['modules'] as $key => $item) :
                        $actionJson = $item['actions'];
                        $actionArr = json_decode($actionJson, true);
                ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['title'] ?></td>
                            <td>
                                <div class="row">
                                    <?php if (!empty($actionArr)) :
                                        foreach ($actionArr as $roleKey => $roleValue) : ?>
                                            <div class="col">
                                                <input type="checkbox" name="permission[<?= $item['name'] ?>][<?= $roleKey ?>]" id="<?= $item['name'] . '_' . $roleKey ?>" value="<?= $roleValue ?>" <?= (!empty($permissionArr[$item['name']][$roleKey])  && ($permissionArr[$item['name']][$roleKey] == $roleValue)) ? 'checked' : false ?> />
                                                <label for="<?= $item['name'] . '_' . $roleKey ?>"><?= $roleValue ?></label>
                                            </div>
                                    <?php endforeach;
                                    endif ?>
                                </div>
                            </td>
                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>

        <input type="hidden" name="id" value="<?= !empty($data['groups']['id']) ? $data['groups']['id'] : false ?>">
        <button type="submit" class="btn btn-primary">Phân quyền</button>
    </form>
</div>
<?php get_footer() ?>