<x-layouts.home>
    <div class="card col-md-10 text-center p-3 shadow-sm overflow-x-scroll">
        <p class="h1 text-success-emphasis fw-bold mb-5">Contact Management</p>

        <div class="sortingOptions d-md-flex d-sm-flex-column justify-content-between mb-1">
            <div class="d-flex col-sm-12 col-md-4 gap-2">
                <div class="col-6">
                    <label for="name">Sort By Name</label>
                    <select class="form-select form-select-md text-center bg-dark text-white" id="name">
                        <option value="default">Default</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="date">Sort By Date</label>
                    <select class="form-select form-select-md text-center bg-dark text-white" id="date">
                        <option value="default">Default</option>
                        <option value="asc">Old</option>
                        <option value="desc">New</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 ">
                <label for="search"></label>
                <div class="d-flex gap-1">
                    <input type="text" class="form-control border-dark" id="search" placeholder="Search Box" />
                    <button class="btn btn-dark" id="search-button">Search</button>
                </div>
            </div>

        </div>



        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark sticky-top">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->address }}</td>
                            <td>
                                <div class="d-flex gap-2 justify-content-evenly">
                                    <button type="button"
                                        class="btn btn-primary  border-0 rounded  fw-semibold px-4 py-2" id="editBtn"
                                        onclick="window.location.href = '{{ route('show', $contact->id) }}'">View</button>

                                    <button type="button"
                                        class="btn btn-warning border-0 rounded  fw-semibold px-4 py-2" id="editBtn"
                                        onclick="window.location.href = '{{ route('edit', $contact->id) }}'">Edit</button>

                                    <form action="{{ route('destroy', $contact->id) }}" method="POST">
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger border-0 rounded fw-semibold px-3 py-2"
                                            id="deleteBtn">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const orderByName = document.getElementById('name');
        const orderByDate = document.getElementById('date');
        const searchInput = document.getElementById('search');
        const searchButton = document.getElementById('search-button');

        // Function to update the URL parameters and navigate to the new URL
        function updateUrlParams(event) {
            event.preventDefault();

            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            // Check if the selected value is the default value
            if (event.target.value === 'default') {
                // Remove the parameter from the URL
                params.delete(event.target.id);
            } else {
                // Update the parameter value in the URL
                params.set(event.target.id, event.target.value);
            }

            // Remove the other parameter from the URL
            if (event.target.id === 'name') {
                params.delete('date');
            } else if (event.target.id === 'date') {
                params.delete('name');
            }

            url.search = params.toString();
            window.location.href = url.href;
        }

        // Function to update the form elements based on URL parameters
        function updateFormElements() {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            // Update the select elements based on URL parameters
            if (params.has('name')) {
                orderByName.value = params.get('name');
            } else {
                orderByName.value = 'default';
            }
            if (params.has('date')) {
                orderByDate.value = params.get('date');
            } else {
                orderByDate.value = 'default';
            }

            // Update the input box based on URL parameter
            if (params.has('search')) {
                searchInput.value = params.get('search');
                if (searchInput.value === '') {
                    params.delete('search');
                    url.search = params.toString();
                    window.location.href = url.href;
                }
            } else {
                searchInput.value = '';
            }
        }

        // Function to handle search button click
        function handleSearchButtonClick() {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

            // Update the search parameter if input value is not null
            if (searchInput.value.trim() !== '') {
                // Update the search parameter value in the URL
                params.set('search', searchInput.value.trim());

                url.search = params.toString();
                window.location.href = url.href;
            }
        }

        // Add event listener to the search input for enter key press
        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                handleSearchButtonClick();
            }
        });

        // Add event listeners to the select elements
        orderByName.addEventListener('change', updateUrlParams);
        orderByDate.addEventListener('change', updateUrlParams);
        searchButton.addEventListener('click', handleSearchButtonClick);

        // Update the select elements on page load
        window.addEventListener('load', function() {
            updateFormElements();
        });
    </script>
</x-layouts.home>
