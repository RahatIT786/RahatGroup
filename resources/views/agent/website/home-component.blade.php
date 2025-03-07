<div>
    <style>
        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Striped Rows */
        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Hover Effect */
        .table tbody tr:hover {
            background-color: #e9e9e9;
        }
    </style>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Agency</th>
                <th>Owner</th>
                <th>City</th>
                <th>Mobile</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $agent->agency_name }}</td>
                <td>{{ $agent->owner_name }}</td>
                <td>{{ $agent->city }}</td>
                <td>{{ $agent->mobile }}</td>
                <td>{{ $agent->email }}</td>
            </tr>
        </tbody>
    </table>
    <br><br><br>
    {{-- <form wire:submit.prevent='loginPost'>
        @csrf
        <input type="email" placeholder="Email" wire:model='email'>
        @error('email')
            <span>{{ $message }}</span>
        @enderror
        <input type="password" placeholder="Password" wire:model='password'>
        @error('password')
            <span>{{ $message }}</span>
        @enderror
        <input type="submit" value="Submit" name="sub">
    </form> --}}
</div>
