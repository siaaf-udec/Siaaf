<?php

namespace App\Mail\Financial;

use App\Container\Financial\src\Extension;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FinancialExtensionGenerated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * @var Extension
     */
    private $extension;

    /**
     * Create a new message instance.
     *
     * @param Extension $extension
     */
    public function __construct(Extension $extension)
    {
        $this->extension = $extension;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('financial.templates.email.email')
                ->subject( __('financial.email.request.title', ['request' => __( 'validation.attributes.extension' ) ]) )
                ->with([
                    'title'     =>      __('financial.email.request.title', ['request' => __( 'validation.attributes.extension' ) ]),
                    'body'      =>      __('financial.email.request.message'),
                    'details'   =>      [
                        'subject_code'      => isset( $this->extension->subject->{ subject_code() } ) ? $this->extension->subject->{ subject_code() } : 0,
                        'subject_name'      => isset( $this->extension->subject->{ subject_name() } ) ? $this->extension->subject->{ subject_name() } : __('financial.generic.empty'),
                        'program_name'      => isset( $this->extension->subject->programs[0]->{ program_name() } ) ? $this->extension->subject->programs[0]->{ program_name() } : __('financial.generic.empty'),
                        'teacher_name'      => isset( $this->extension->subject->teachers[0]->full_name ) ? $this->extension->subject->teachers[0]->full_name : __('financial.generic.empty'),
                        'total_cost'        => isset( $this->extension->total_cost ) ? toMoney( $this->extension->total_cost ) : toMoney( 0 ),
                    ],
                    'button'    =>      __('financial.email.request.button'),
                    'url'       =>      route('financial.requests.student.extension.show', ['id' => isset( $this->extension->{ primaryKey() } ) ? $this->extension->{ primaryKey() } : 0])
                ]);
    }
}