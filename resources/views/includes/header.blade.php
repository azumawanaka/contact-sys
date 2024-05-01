<div class="row">
    <div class="col-md-12 d-flex justify-content-end align-items-center mb-3 header-links">
        <!-- Links -->
        <div class="me-3">
            <a href="{{ route('contact.create') }}" class="{{ request()->route()->getName() === 'contact.create' ? 'active' : '' }}">Add Contact</a>
        </div>
        <div class="me-3">|</div>
        <div class="me-3">
            <a href="{{ route('contact.index') }}" class="{{ request()->route()->getName() === 'contact.index' ? 'active' : '' }}">Contacts</a>
        </div>
        <div class="me-3">|</div>
        <div>
            <a  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>