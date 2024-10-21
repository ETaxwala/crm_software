@include('ui.header')

<main class="app-content">
    {{-- <div class="">
        <a class="btn btn-primary" href="{{ route('quotation.create') }}"><i class="fa fa-plus"></i> Create New Invoice</a>
    </div> --}}

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Quotation ID </th>
                                <th>Customer Name </th>
                                <th>Date </th>
                                <th>Created By </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($quotations) > 0)
                                @foreach ($quotations as $invoice)
                                    <tr>
                                        <td>{{ 0 + $invoice->id }}</td>
                                        <td>{{ $invoice->lead->name }}</td>
                                        <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $invoice->created_by }}</td>
                                        <td>
                                            <a class="ms-btn-icon btn-success"
                                                href="{{ route('quotation.show', $invoice->id) }}"><i
                                                    class="fa fa-eye"></i></a>
                                            <a class="ms-btn-icon btn-info"
                                                href="{{ route('quotation.edit', $invoice->id) }}"><i
                                                    class="fa fa-edit"></i></a>

                                            <span class="ms-btn-icon btn-danger" type="submit"
                                                onclick="deleteTag({{ $invoice->id }})">
                                                <i class="fa fa-trash"></i>
                                                </aspan>
                                                <form id="delete-form-{{ $invoice->id }}"
                                                    action="{{ route('quotation.destroy', $invoice->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="bg-secondary text-white">
                                    <td colspan="4" class="text-center">
                                        No Record Found
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


@include('ui.footer')

<script type="text/javascript">
    function deleteTag(id) {
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-' + id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === swal.DismissReason.cancel
            ) {
                swal(
                    'Cancelled',
                    'Your data is safe :)',
                    'error'
                )
            }
        })
    }
</script>
