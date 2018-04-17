<?php


use App\Container\Financial\src\Constants\ConstantRoles;
use App\Container\Financial\src\Helpers\StringFormatter;
use App\Container\Financial\src\Constants\ConstantLabelClasses;
use App\Container\Financial\src\Constants\SchemaConstant;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Retrieve a hash to create a IdentiIcon
 *
 * @return mixed
 */
function iconHash() { return substr_replace(sha1(microtime(true)), '', 16); }

/**
 * Retrieve text to upper
 *
 * @param null $string
 * @return mixed|string
 */
function toUpper( $string = null ) {
    return StringFormatter::toUpper( $string );
}

/**
 * Retrieve values to currency format
 *
 * @param int $currency
 * @return string
 */
function toMoney( $currency = 0 ) {
    return StringFormatter::toMoney( $currency );
}

/**
 * Retrieve string with attributes to
 * use on html tags
 *
 * @param string $attributes
 * @return string
 */
function htmlAttributes( $attributes = null ) {
    return StringFormatter::htmlAttributes( $attributes );
}

/**
 * Retrieve Bootstrap class
 * info - warning - danger - success - default
 *
 * @param string $type
 * @return string
 */
function htmlClasses( $type = 'default' ) {
    return ConstantLabelClasses::className( $type );
}

/**
 * Retrieve boolean if icon is a hash or a file
 *
 * @param $file
 * @return bool
 */
function isIdentIcon( $file ) {
    return ( strlen( $file ) == 16 ) ? true : false;
}

/**
 * Return HTML links to Data Tables actions or
 * any others uses
 *
 * @param string $route
 * @param string $class
 * @param string $icon
 * @param string $attributes
 * @param string $text
 * @return string
 * @throws Throwable
 */
function actionLink( $route, $class = '', $icon = 'fa fa-square', $attributes = '', $text = '' ){

    try {
        return view('financial.templates.actions.button',
            [
                'link'       => $route,
                'class'      => $class,
                'icon'       => $icon,
                'text'       => $text,
                'attributes' => htmlAttributes($attributes),
            ]
        )->render();
    }catch (Exception $e) {
        report($e);
        return false;
    }
}

function customPagination( $source, $model ) {
    return new LengthAwarePaginator(
        $source,
        $model->total(),
        $model->perPage(),
        $model->currentPage(), [
            'path' => Request::url(),
            'query' => [
                'page' => $model->currentPage()
            ]
        ]);
}

/**
 * Return HTML label to Data Tables or
 * any others uses
 *
 * @param string $type
 * @param string $text
 * @return string
 * @throws Throwable
 */
function labelHtml($type = 'default', $text = '' ) {
    try {
        return view('financial.templates.labels.label', compact('type', 'text'))
            ->render();
    }catch (Exception $e) {
        report($e);
        return false;
    }
}

/**
 * @param $max
 * @param $now
 * @return bool|string
 * @throws Throwable
 */
function progressBar( $max, $now ) {
    try {
        $percent = ( (float) $now * 100 ) / (float) $max;
        $class = 'danger';
        if ( (float) $percent >= 60 && (float) $percent <= 80 ) {
            $class = 'warning';
        } elseif ( (float) $percent > 80 ) {
            $class = 'success';
        }
        return view('financial.templates.progress.progress', compact('max', 'now', 'percent', 'class'))
            ->render();
    }catch (Exception $e) {
        report($e);
        return false;
    }
}

/**
 * Return a json response to Axios
 *
 * @param string $title
 * @param string $message
 * @param int $status
 * @return \Illuminate\Http\JsonResponse
 */
function jsonResponse($title = 'success', $message = 'processed', $status = 200 ) {
    $message = [
        'title'     =>  trans("javascript.$title"),
        'message'   =>  trans("javascript.$message")
    ];
    return response()->json($message, $status);
}

/**
 * Minimum subscribers required to create Inersemestral
 *
 * @return int
 */
function minSubscribedIntersemestral() { return 15; }

/**
 * Minimum subscribers paid to approve Inersemestral
 *
 * @return int
 */
function minPaidIntersemestral() { return 12; }

/**
 * Return if the month is in first or second semester of the year
 *
 * @param $month
 * @return int
 */
function isFirstSemester( $month ) {
    return ( intval($month) >= 1 && intval($month) <= 6 ) ? true : false;
}

/**
 * Return true if auth user has email
 *
 * @return bool
 */
function authUserHasEmail() { return isset( auth()->user()->email ) ? true : false; }

/**
 * Return an array with interpolated values
 *
 * @param $a
 * @param $b
 * @return array
 */
function array_interpolate($a, $b) {
    $size = sizeof($a) > sizeof($b) ? sizeof($a) : sizeof($b);
    $result = array();
    for ($i = 0; $i < $size; $i++) {
        if ( isset( $a[$i] ) ) $result[2*$i] = $a[$i];
        if ( isset( $b[$i] ) ) $result[2*$i+1] = $b[$i];
    }
    return $result;
}

function randomClassesBadge() {
    return array_random([
        'badge-default',
        'badge-primary',
        'badge-info',
        'badge-success',
        'badge-danger',
        'badge-warning',
    ]);
}

/**
 * Return the services of the university
 *
 * @param null $exceptKey
 * @param bool $pluck
 * @return array
 */
function requestsList( $exceptKey = null, $pluck = false ) {

    $sources = [
        [
            'id'      => 'extension',
            'text'    => ucfirst( trans('validation.attributes.extension') ),
        ],
        [
            'id'      => 'add_remove_subjects',
            'text'    => ucfirst( trans('validation.attributes.add_remove_subjects') ),
        ],
        [
            'id'      => 'validation',
            'text'    => ucfirst( trans('validation.attributes.validation') ),
        ],
        [
            'id'      => 'intersemester',
            'text'    => ucfirst( trans('validation.attributes.intersemester') ),
        ],
        [
            'id'      => 'file',
            'text'    => ucfirst( trans('validation.attributes.file') ),
        ],
    ];

    if ( is_string( $exceptKey ) && $exceptKey !== null ) {
        foreach ( $sources as $source ) {
            if ( $exceptKey !== $source['id'] ) $array[] = $source;
        }
    }

    if ($pluck) $array = array_pluck( isset( $array ) ? $array : $sources, 'text', 'id' );

    return isset( $array ) ? $array : $sources;
}

/*
|--------------------------------------------------------------------------
| Roles Helper
|--------------------------------------------------------------------------
|
| This functions return the fields name of the roles
*/

function student_role() { return ConstantRoles::FINANCIAL_STUDENT_ROLE; }

function admin_role() { return ConstantRoles::FINANCIAL_ADMIN_ROLE; }

function teacher_role() { return ConstantRoles::FINANCIAL_TEACHER_ROLE; }

function secretary_role() { return ConstantRoles::FINANCIAL_SECRETARY_ROLE; }

function access_roles() {
    return [
        admin_role(),
        teacher_role(),
        secretary_role(),
    ];
}

/*
|--------------------------------------------------------------------------
| Database Helper
|--------------------------------------------------------------------------
|
| This functions return the fields name of the database
| to access dynamic at database if the names changes
*/

function table_prefix() { return SchemaConstant::TABLE_PREFIX; }

/**
 * Return Primary Key Text
 *
 * @return string
 */
function primaryKey() { return SchemaConstant::PRIMARY_KEY; }

/**
 * Return Student Foreign Key Text
 *
 * @return string
 */
function student_fk(){ return SchemaConstant::STUDENT_FOREIGN_KEY; }

/**
 * Return Teacher Foreign Key Text
 *
 * @return string
 */
function teacher_fk(){ return SchemaConstant::TEACHER_FOREIGN_KEY; }

/**
 * Return User Foreign Key Text
 *
 * @return string
 */
function user_fk(){ return SchemaConstant::USER_FOREIGN_KEY; }

/**
 * Return Cost Foreign Key Text
 *
 * @return string
 */
function cost_service_fk(){ return SchemaConstant::COST_FOREIGN_KEY; }

/**
 * Return Subject Foreign Key Text
 *
 * @return string
 */
function subject_fk(){ return SchemaConstant::SUBJECT_FOREIGN_KEY; }

/**
 * Return Program Foreign Key Text
 *
 * @return string
 */
function program_fk(){ return SchemaConstant::PROGRAM_FOREIGN_KEY; }

/**
 * Return Status Foreign Key Text
 *
 * @return string
 */
function status_fk(){ return SchemaConstant::STATUS_FOREIGN_KEY; }

/**
 * Return Intersemestral Foreign Key Text
 *
 * @return string
 */
function intersemestral_fk(){ return SchemaConstant::INTERSEMESTRAL_FOREIGN_KEY; }

/**
 * Return File type Foreign Key Text
 *
 * @return string
 */
function file_type_fk(){ return SchemaConstant::FILE_TYPE_FOREIGN_KEY; }

/**
 * Return Extension Foreign Key Text
 *
 * @return string
 */
function extension_fk(){ return SchemaConstant::EXTENSION_FOREIGN_KEY; }

/**
 * Return Status Field Text
 *
 * @return string
 */
function status(){ return SchemaConstant::STATUS; }

/**
 * Return Cost Field Text
 *
 * @return string
 */
function cost(){ return SchemaConstant::COST; }

/**
 * Return Paid Field Text
 *
 * @return string
 */
function paid(){ return SchemaConstant::PAID; }

/**
 * Return Cost Service Name Field Text
 *
 * @return string
 */
function cost_service_name(){ return SchemaConstant::COST_SERVICE_NAME; }

/**
 * Return Cost Valid Until Field Text
 *
 * @return string
 */
function cost_valid_until(){ return SchemaConstant::COST_VALID_UNTIL; }

/**
 * Return Status Name Field Text
 *
 * @return string
 */
function status_name(){ return SchemaConstant::STATUS_NAME; }

/**
 * Return Status Type Field Text
 *
 * @return string
 */
function status_type(){ return SchemaConstant::STATUS_TYPE; }

/**
 * Return Program Name Field Text
 *
 * @return string
 */
function program_name(){ return SchemaConstant::PROGRAM_NAME; }

/**
 * Return Approval Date Field Text
 *
 * @return string
 */
function approval_date(){ return SchemaConstant::APPROVAL_DATE; }

/**
 * Return Approved By Field Text
 *
 * @return string
 */
function approved_by(){ return SchemaConstant::APPROVED_BY; }

/**
 * Return Realization Date Field Text
 *
 * @return string
 */
function realization_date(){ return SchemaConstant::REALIZATION_DATE; }

/**
 * Return Action Subject Field Text
 *
 * @return string
 */
function action_subject(){ return SchemaConstant::ACTION_SUBJECT; }

/**
 * Return Subject Code Field Text
 *
 * @return string
 */
function subject_code(){ return SchemaConstant::SUBJECT_CODE; }

/**
 * Return Subject Name Field Text
 *
 * @return string
 */
function subject_name(){ return SchemaConstant::SUBJECT_NAME; }

/**
 * Return Subject Credit Field Text
 *
 * @return string
 */
function subject_credits(){ return SchemaConstant::SUBJECT_CREDITS; }

/**
 * Return Comment Field Text
 *
 * @return string
 */
function comment(){ return SchemaConstant::COMMENT; }

/**
 * Return File Route Field Text
 *
 * @return string
 */
function file_route(){ return SchemaConstant::FILE_ROUTE; }

/**
 * Return File Name Field Text
 *
 * @return string
 */
function file_name(){ return SchemaConstant::FILE_NAME; }

/**
 * Return File Type Field Text
 *
 * @return string
 */
function file_types(){ return SchemaConstant::FILE_TYPE; }

/**
 * Return Created At Field Text
 *
 * @return string
 */
function created_at(){ return SchemaConstant::CREATED_AT; }

/**
 * Return Updated At Field Text
 *
 * @return string
 */
function updated_at(){ return SchemaConstant::UPDATED_AT; }

/**
 * Return Deleted At Field Text
 *
 * @return string
 */
function deleted_at(){ return SchemaConstant::DELETED_AT; }
