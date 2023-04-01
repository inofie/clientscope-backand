@foreach ( $childs as $child )
    <tr>
        <td>
            <div class="chat-detail table-deatil d-flex align-items-center">
                <div>
                    <div class="other-chat-img">
                        <img src="{{ $child->image_url }}"
                            alt="user-profile" />
                    </div>
                </div>
                <div class="other-user-names ml-3 table-user-name">
                    <p class="font-18">{{ $child->name }}</p>
                </div>
            </div>
        </td>
        <td class="color-04e013 font-20">{{ $child->status }}</td>
        <td class="text-right">
            <a data-target="#editUser" href="{{ URL::to('admin/user/manage/'.$child->id) }}" class="_edit_user">
                <img src="{{ asset('assets/images/table-edit.png') }}" alt="user-profile" />
            </a>
        </td>
    </tr>
    @if( !empty($child->child) )
        @include('admin.ajax-component.child-manage-user',['childs' => $child->child])
    @endif
@endforeach        
