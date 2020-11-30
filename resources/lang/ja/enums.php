<?php
use App\Enums\Status;

return [
    Status::class => [
      Status::UnApplied   => '未申請',
      Status::Registering => '登録申請中',
      Status::Deleting    => '削除申請中',
    ],
];