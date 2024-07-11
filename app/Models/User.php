<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\Fortify;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // use  HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'DOB',
        'gender',
        'email',
        'password',
        'role_id',
        'suspended',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    // If you're using a different primary key
    protected $primaryKey = 'id';

    // If your table is named differently
    protected $table = 'users';
    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */



    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role_id' => 'integer',
            'suspended' => 'boolean', 
        ];
    }


    //Relationship with role model
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class);
    // }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->roles->contains('role_name', $role);
    }

    public function assignRole($roleId)
    {
        $this->roles()->attach($roleId);
    }
    public function getIsSuspendedAttribute()
    {
        return $this->suspended; // Assuming 'is_suspended' is the column name
    }
    // Method to check if user has a specific permission
    // public function hasPermission($permission)
    // {
    //     return $this->permissions->contains('name', $permission);
    // }

    // Method to check if user has a specific role
    public function isTherapist()
    {
        return $this->role && $this->role->role_name === 'Therapist';
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    //relationship between User and messages

    // public function ()
    // {
    //     return $this->hasMany(Message::class);
    // }
    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
    public function feedbackMessages()
    {
        return $this->hasMany(FeedbackMessage::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'employee_id');
    }

    // public function evaluationForms()
    // {
    //     return $this->hasMany(EvaluationForm::class);
    // }

    //check if user is suspended
    public function isSuspended()
    {
        return $this->suspended;
    }
}
