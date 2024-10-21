@include('ui.header')

<!-- Body Content Wrapper -->
<div class="ms-content-wrapper">
    <div class="row">

        <div class="col-md-12">

            <div class="ms-panel">
                <div class="ms-panel-header">
                    <h6>Manage Resume</h6>
                </div>
                <div class="ms-panel-body">
                    <div class="table-responsive">
                        <table id="table" class="table w-100 thead-primary data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Education</th>
                                    <th>Experience</th>
                                    <th>Salary(LPA)</th>
                                    <th>Position</th>
                                    <th>OnSite</th>
                                    <th>Resume</th>
                                    <th>Address</th>
                                    <th>Date</th>

                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">

                                @foreach ($resumes as $resume)
                                    <tr>
                                        <td>{{ $resume->name }}</td>
                                        <td>{{ $resume->email }}</td>
                                        <td>{{ $resume->contact }}</td>
                                        <td>{{ $resume->education }}</td>
                                        <td>{{ $resume->experience }}</td>
                                        <td>{{ $resume->salary }}</td>
                                        <td>{{ $resume->position }}</td>
                                        <td>{{ $resume->onssite }}</td>
                                        <td><a href="{{ url('public/Resume/') }}/{{$resume->resume}}" download="{{$resume->resume}}">{{ $resume->resume }}</a></td>
                                        <td>{{ $resume->address }}</td>
                                        <td>{{ $resume->date }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@include('ui.footer')
