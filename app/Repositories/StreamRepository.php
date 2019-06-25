<?php

namespace App\Repositories;

use App\Stream;

class StreamRepository extends BaseRepository
{
    //构造函数
    public function __construct()
    {
        $this->table = 'streams';
        $this->id = 'stream_id';
    }

    //获取到直播流的数据
    public function getStream()
    {
        return Stream::get();
    }
}
