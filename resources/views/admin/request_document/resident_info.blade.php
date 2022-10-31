<table class="table">
    <tbody class="text-uppercase">
    <tr>
        <th scope="row">Name</th>
        <td>{{$resident->name ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Address</th>
        <td>{{$resident->address ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Contact Number</th>
        <td>{{$resident->contact_number ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Birth Date</th>
        <td>{{$resident->birthdate ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Birth Place</th>
        <td>{{$resident->birthplace ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Civil Status</th>
        <td>{{$resident->civil_status ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Gender</th>
        <td>{{$resident->gender ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Is Voter?</th>
        <td>
            <span class="badge badge-sm {{$resident->isVoter == true ? 'bg-success':'bg-danger'}}">
                {{$resident->isVoter == true ? 'YES':'NO'}}
            </span>
        </td>
    </tr>
    <tr>
        <th scope="row">With Record?</th>
        <td>
            <span class="badge badge-sm {{$resident->isRecord == true ? 'bg-success':'bg-danger'}}">
                {{$resident->isRecord == true ? 'YES':'NO'}}
            </span>
        </td>
    </tr>
    <tr>
        <th scope="row">Is Employed?</th>
        <td>
            <span class="badge badge-sm {{$resident->isEmployed == true ? 'bg-success':'bg-danger'}}">
                {{$resident->isEmployed == true ? 'YES':'NO'}}
            </span>
        </td>
    </tr>
    <tr>
        <th scope="row">Is Student?</th>
        <td>
            <span class="badge badge-sm {{$resident->isStudent == true ? 'bg-success':'bg-danger'}}">
                {{$resident->isStudent == true ? 'YES':'NO'}}
            </span>
        </td>
    </tr>
    <tr>
        <th scope="row">Is PWD?</th>
        <td>
            <span class="badge badge-sm {{$resident->isPWD == true ? 'bg-success':'bg-danger'}}">
                {{$resident->isPWD == true ? 'YES':'NO'}}
            </span>
        </td>
    </tr>
    <tr>
        <th scope="row">Senior Citizen?</th>
        <td>
            <span class="badge badge-sm {{$resident->isSr == true ? 'bg-success':'bg-danger'}}">
                {{$resident->isSr == true ? 'YES':'NO'}}
            </span>
        </td>
    </tr>
    <tr>
        <th scope="row">Register At?</th>
        <td>
            {{$resident->created_at->format('M j , Y h:i A') ?? ''}}
        </td>
    </tr>
    </tbody>
</table>