
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a  class="nav-link
            @if( Route::current()->getName() == 'admin.organisation.edit.general.page' )
                active
            @endif" 
            href="{{ route('admin.organisation.edit.general.page', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}">General</a>
    </li>
    <li class="nav-item">
        <a  class="nav-link
            @if( Route::current()->getName() == 'admin.organisation.edit.profile.page' )
                active
            @endif" 
            href="{{ route('admin.organisation.edit.profile.page', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}">Profile information</a>
    </li>
    <li class="nav-item">
        <a  class="nav-link
            @if( Route::current()->getName() == 'admin.organisation.edit.contact.page' )
                active
            @endif" 
            href="{{ route('admin.organisation.edit.contact.page', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}">Contact</a>
    </li>
    <li class="nav-item">
        <a  class="nav-link
            @if( Route::current()->getName() == 'admin.organisation.edit.users.page' )
                active
            @endif" 
            href="{{ route('admin.organisation.edit.users.page', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}">Organization Users</a>
    </li>
    <li class="nav-item">
        <a  class="nav-link
            @if( Route::current()->getName() == 'admin.organisation.edit.admins.page' )
                active
            @endif" 
            href="{{ route('admin.organisation.edit.admins.page', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}">Organization Admins</a>
    </li>
</ul>