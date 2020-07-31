<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Helpers\UploadTrait;

class Actor extends Model {
	
	use UploadTrait;
	use LogsActivity;
	
	public const UPLOAD_FOLDER_NAME = 'actors';
	public const PAGER_SETTINGS = [
		'cookie' => [
			'param_name' => 'actors_pager_list_size',
			'expires' => 365,
		],
		'list_size' => [
			'default' => 10,
			'items' => [10, 25, 50, 100],
		]
	];
	public const REQUEST_PARAM_NAME_ON_FILMS = 'actor_id';
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'actors';

	/**
	 * The database primary key value.
	 *
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * Attributes that should be mass-assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['full_name', 'date_birth'];

	/**
	 * Change activity log event description
	 *
	 * @param string $eventName
	 *
	 * @return string
	 */
	public function getDescriptionForEvent($eventName) {
		return __CLASS__ . " model has been {$eventName}";
	}
	/**
	 * Related films
	 * 
	 * @return type
	 */
	public function films() {
		return $this->belongsToMany(Film::class, 'film_actor');
	}
	/**
	 * The names of films
	 * 
	 * @return array
	 */
	public function verboseFilms(): array {
		if ($this->films->isEmpty()) {
			return [];
		}
		
		return $this->films()->pluck('name')->all();
	}
	/**
	 * Date of Birth
	 * 
	 * @param type $value
	 * @return string
	 */
	public function getDateBirthAttribute($value): string {
		return !empty($value) ? \Carbon\Carbon::parse($value)->format('Y-m-d') : '';
	}
	/**
	 * The path of upload
	 * 
	 * @return string
	 */
	public static function uploadPath(): string {
		return config('filesystems.upload_folder_name') . DIRECTORY_SEPARATOR . self::UPLOAD_FOLDER_NAME;
	}
	/**
	 * The ruls of validation
	 * 
	 * @return array
	 */
	public static function validationRuls(): array {
		return [
			'full_name' => 'required|string',
			'image' => 'image|dimensions:min_width=100,max_width=200,min_height=100,max_height=200|max:1024',
			'date_birth' => 'date|nullable',
		];
	}
}
