<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

	// 定義當使用 __construct($data) 或 create($data) 時
    // 可以被修改的欄位，進而保護其他欄位不被修改
	protected $fillable = ['title', 'body'];

}
