<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Investors{
/**
 * App\Models\Investors\Classification
 *
 * @property int $id
 * @property string $title
 * @property float $total_investment
 * @property string $referral_rate
 * @property array|null $freebies
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereFreebies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereReferralRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereTotalInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classification withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Classification withoutTrashed()
 */
	class Classification extends \Eloquent {}
}

namespace App\Models\Investors{
/**
 * App\Models\Investors\Investor
 *
 * @property string $id
 * @property string $status
 * @property string $referral_code
 * @property string|null $referred_by
 * @property float $referral_bonus
 * @property int $age
 * @property string $occupation_type
 * @property array $occupation_data
 * @property string|null $user_id
 * @property int|null $classification_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Investors\Classification|null $classification
 * @property-read int|float $total_investments
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transactions\Investment> $investments
 * @property-read int|null $investments_count
 * @property-read Investor|null $referral
 * @property-read \App\Models\Users\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Investor active()
 * @method static \Database\Factories\Investors\InvestorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Investor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Investor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Investor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Investor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereClassificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereOccupationData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereOccupationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereReferralBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereReferralCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereReferredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investor withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Investor withoutTrashed()
 */
	class Investor extends \Eloquent {}
}

namespace App\Models\Investors{
/**
 * App\Models\Investors\InvestorSubmission
 *
 * @property string $id
 * @property string $status
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $contact_no
 * @property string $email
 * @property int $age
 * @property string|null $referred_by
 * @property string $occupation_type
 * @property array $occupation_data
 * @property float $investment_amount
 * @property string $reference_no
 * @property string $payment_method
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Investors\Investor|null $referral
 * @method static \Database\Factories\Investors\InvestorSubmissionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission pending()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereContactNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereInvestmentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereOccupationData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereOccupationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereReferenceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereReferredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InvestorSubmission whereUpdatedAt($value)
 */
	class InvestorSubmission extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\Category
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models\Products{
/**
 * App\Models\Products\Product
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int|null $category_id
 * @property string|null $photo
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models\Transactions{
/**
 * App\Models\Transactions\Investment
 *
 * @property string $id
 * @property float $amount
 * @property string $status
 * @property string $payment_method
 * @property string $reference_no
 * @property string|null $investor_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Investors\Investor|null $investor
 * @method static \Database\Factories\Transactions\InvestmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Investment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereInvestorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereReferenceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Investment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Investment withoutTrashed()
 */
	class Investment extends \Eloquent {}
}

namespace App\Models\Transactions{
/**
 * App\Models\Transactions\Withdrawal
 *
 * @property string $id
 * @property float $amount
 * @property string $status
 * @property string $payment_method
 * @property string $account_number
 * @property string|null $investor_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Investors\Investor|null $investor
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereInvestorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdrawal withoutTrashed()
 */
	class Withdrawal extends \Eloquent {}
}

namespace App\Models\Users{
/**
 * App\Models\Users\User
 *
 * @property string $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $contact_no
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name
 * @property-read string $initials
 * @property-read string $name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\Users\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereContactNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

