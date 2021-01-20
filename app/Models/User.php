<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;

    /**
     * @method whereNotNull(string $string)
     * @method static find($auth)
     * @method static delete()
     * @method static save()
     * @property mixed id
     * @property mixed cell
     * @property mixed email
     * @property bool verificado
     * @property mixed usuario
     * @property string password
     * @property mixed celular
     */
    class User extends Authenticatable
    {
        use HasFactory, Notifiable;
        
        /**
         * @var string table name
         */
        protected $table = 'usuario';
        
        /**
         * @var bool for block update timestamp updated_at and created_at
         */
//        public $timestamps = false;
        
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'id', 'usuario', 'email',
        ];
        
        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = [
            'password', 'verificado', 'updated_at', 'created_at', 'device_token'
        ];

//        /**
//         * The attributes to cast include in database
//         *
//         * @var array
//         */
//        protected $casts = [
//            'date_column' => 'Timestamp'
//        ];

//        public function update(array $attributes = [], array $options = []) {
//            // ... your implementation
//            return parent::update($attributes, $options);
//        }
        
        public static function pushTokenList()
        {
            return (new User)->whereNotNull('device_token')->pluck('device_token')->all();
        }
        
        public static function emailList()
        {
            return (new User)->whereNotNull('email')->pluck('email')->all();
        }
        
        public function routeNotificationForNexmo($notification = null)
        {
            return '8990';
        }
    }
