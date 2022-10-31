<table class="table">
    <tbody class="text-uppercase">
    <tr>
        <th scope="row">Name</th>
        <td>{{$document->name ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Amount</th>
        <td>₱ {{$document->amount ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Requirements</th>
        <td> 
            @foreach($document->requirements()->get() as $requirement)
                * {{$requirement->name ?? ''}} <br>
            @endforeach
        </td>
       
    </tr>
    </tbody>
</table>