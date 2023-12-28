<?php

function construct()
{
    load_model('index');
}

function indexAction()
{
    $data['exam_count'] = get_count_exam();
    $data['media_count'] = get_count_media();
    load_view('index', $data);
}

function indexPostAction()
{
    $examinations = get_examination();
    $subject_media = get_subject_media(133, 9);
    $count_subject_media = get_count_media();

    foreach ($examinations as $key => $exam) {
        $dataInsert = [
            'creator_id' => 1,
            'examination_id' => $exam['id'],
            'subject_media_id' => rand(1, $count_subject_media),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        insert('examination_medias', $dataInsert);
    }

    redirect('?role=admin&mod=exam_media');
}
