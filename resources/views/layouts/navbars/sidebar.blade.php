<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-normal text-center">{{ _('Notices') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'notice') class="active " @endif>
                <a href="{{ route('notice.index')  }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ _('Notice Management') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'profile') class="active " @endif>
                <a href="{{ route('profile.edit')  }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>{{ _('User Profile') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
