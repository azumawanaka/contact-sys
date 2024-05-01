@extends('layouts.app')

@section('content')
<div class="container">

    @include('includes.header')

    <div class="row justify-content-end">
        <div class="col-md-3 mb-4">
            <!-- Search Bar -->
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
                <input type="search" class="form-control" id="searchQuery" name="filter" placeholder="Search contacts...">
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <h2>{{ __('Contacts') }}</h2>

            {{-- Contact Lists starts here --}}
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>COMPANY</th>
                        <th>PHONE</th>
                        <th>EMAIL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="contactTableBody">
                    <!-- Example contacts -->
                    @if(count($contacts) > 0)
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->company }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>
                                <a href="{{ route('contact.edit', ['contact' => $contact]) }}" class="text-info">Edit</a> |
                                <a href="#" class="text-danger delete-contact"
                                    data-route="{{ route('contact.destroy', ['contact' => $contact]) }}"
                                    data-contact-id="{{ $contact->id }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="5">Empty</td></tr>
                    @endif
                </tbody>
            </table>
            {{-- Contact Lists ends here --}}

            {{ $contacts->onEachSide(1)->links('vendor.pagination.custom') }}
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to DELETE?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Container to display search results -->
    <div class="modal fade" id="searchResultModal" tabindex="-1" aria-labelledby="searchResultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchResultModalLabel">Search Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="searchResults" class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="toaster position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 5">
        <div id="toastContainer" class="toast-container"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
   
   $(document).ready(function() {
        var token = $('meta[name="csrf-token"]').attr('content');
        var route;
        $(document).on('click', '.delete-contact', function () {
            var contactId = $(this).data('contact-id');
            route = $(this).data('route');
            
            $('#confirmDeleteBtn').attr('data-contact-id', contactId);
            $('#deleteConfirmationModal').modal('show');
        })
        $('.delete-contact').click(function() {
            var contactId = $(this).data('contact-id');
            route = $(this).data('route');
            
            $('#confirmDeleteBtn').attr('data-contact-id', contactId);
            $('#deleteConfirmationModal').modal('show');
        });

        $(document).on('input', '#searchQuery', function () {
            var query = $(this).val().trim();
            fetchSearchResults(query);
        });

        function fetchSearchResults(query) {
            $.ajax({
                url: '/contact/search', // Replace with your search route
                method: 'GET',
                data: { query: query },
                success: function(response) {
                    $('#searchResultModal').modal('show');
                    $('#searchResults').html(response.html);
                },
                error: function(error) {
                    console.error('Error fetching search results:', error);
                }
            });
        }
    });

    function showToast(message, type) {
        var toast = $('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true"></div>');
        var toastClass = 'bg-' + type + ' text-white';

        toast.html('<div class="toast-body">' + message + '</div>');

        toast.addClass(toastClass);

        $('#toastContainer').append(toast);
        var toastObj = new bootstrap.Toast(toast[0]);
        toastObj.show();

        setTimeout(function() {
            toastObj.hide();
            toast.on('hidden.bs.toast', function() {
                toast.remove();
            });
        }, 3000);
    }
  </script>
@endpush