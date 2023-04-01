<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
       return [
           'id'               => $this->id,
           'name'             => $this->name,
           'username'         => $this->username,
           'email'            => $this->email,
           'mobile_no'        => $this->mobile_no,
           'image_url'        => !empty($this->image_url) ? \URL::to($this->image_url) : \URL::to('images/user-placeholder.png'),
           'platform_type'    => $this->platform_type,
           'platform_id'      => $this->platform_id,
           'device_type'      => $this->device_type,
           'device_token'     => $this->device_token,
           'is_mobile_verify' => $this->is_mobile_verify,
           'is_email_verify'  => $this->is_email_verify,
           'status_id'        => $this->status_id,
           'is_login'         => $this->is_login,
           'is_active'        => $this->is_active,
           'token'            => $this->token,
           'created_at'       => $this->created_at,
           'user_meta'        => $this->userMetaKeyMapping($this->userMeta),
           'parent_user'      => $this->whenLoaded('parentUser'),
           'user_team'        => $this->whenLoaded('userTeam'),
           'user_role'        => $this->userRole,
           'user_company'     => $this->whenLoaded('userCompany'),
           'report_user'      => $this->whenLoaded('reportToUser'),
           'user_sale_plan'   => $this->whenLoaded('userSalesPlan'),
           'user_metric'      => $this->userMetricKeyMapping($this->userMetric),
           'show_territory'   => !empty($this->show_territory) ? $this->show_territory : NULL,
           'show_count'       => !empty($this->show_count) ? $this->show_count : NULL, 

       ];
    }

    private function userMetricKeyMapping($records)
    {
        $data = [];
        if( count($records) ){
            foreach( $records as $record ){
                $data[$record->metric_slug] = $record->value;
            }
        }
        return $data;
    }

    private function userMetaKeyMapping($userMeta)
    {
        $data = [
            'pin_view_permission'         => 'own_subordinate',
            'pin_edit_permission'         => 'own_subordinate',
            'manager_pin_view_permission' => '',
            'manager_edit_permission'     => '',
            'is_administrator'            => '0',
            'manage_user'                 => '0',
            'can_import_pin'              => '0',
            'share_report'                => '0',
        ];
        if( count($userMeta) )
        {
            foreach ( $userMeta as $meta ){
                $data[$meta->meta_key] = $meta->meta_value;
            }
        }
        return $data;
    }
}
