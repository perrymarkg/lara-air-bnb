<form action="{{ $submit_url }}" method="POST" class="form bg-white p-3 rounded border">
    {{ csrf_field() }}
    @if( $mode == 'edit')
        @method('PUT')
    @endif
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="title" >Title</label>
            <input 
                type="text" 
                class="form-control" 
                value="{{ Helper::displayInputValue( old('title'), $listing->title) }}" 
                name="title" 
                id="title"
                />
        </div>       
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="address">Address</label>
            <textarea 
                name="address" 
                id="address" 
                class="form-control"
                rows="2">{{ Helper::displayInputValue( old('address'), $listing->address) }}</textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="country">Country</label> {{ old('country_id')}}
            <select name="country_id" id="country" class="form-control">
                
                <option value=""></option>
                @foreach(Country::all() as $country)
                    <option 
                        value="{{ $country->id}}" 
                        {{ Helper::setSelectedOption( $country->id, old('country_id'), $listing->country_id )  }}
                        >{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="phone">Phone</label>
            <input 
                type="text" 
                class="form-control"
                name="phone"
                id="phone"
                value="{{ Helper::displayInputValue( old('phone'), $listing->phone ) }}"
                />
        </div>
        <div class="form-group col-md-4">
            <label for="price">Price (Per/Night)</label>
            <input 
                type="text" 
                class="form-control" 
                name="price" 
                id="price"
                value="{{ Helper::displayInputValue( old('price'), $listing->price, 'price' ) }}"
                />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="type">Listing Type</label>
            <select name="type" id="type" class="form-control">
                <option value="1" {{ $listing->type === 1 ? 'selected' : ''}}>Whole House</option>
                <option value="2" {{ $listing->type === 2 ? 'selected' : ''}}>Private Room</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="max_kids">Max Kids</label>
            <select name="max_kids" id="max_kids" class="form-control">
                @for( $x = 0; $x <= 10; $x++)
                <option 
                    value="{{ $x }}" 
                    {{ Helper::setSelectedOption( $x, old('max_kids'), $listing->max_kids )  }}
                    >{{ $x }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="max_adults">Max Adults</label>
            <select name="max_adults" id="max_adults" class="form-control">
                @for( $x = 1; $x <= 10; $x++)
                <option 
                    value="{{ $x }}" 
                    {{ Helper::setSelectedOption( $x, old('max_adults'), $listing->max_adults )  }}
                    >{{ $x }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="bedrooms">Bedrooms</label>
            <select name="bedrooms" id="bedrooms" class="form-control">
                @for( $x = 0; $x <= 10; $x++)
                <option 
                    value="{{ $x }}" 
                    {{ Helper::setSelectedOption( $x, old('bedrooms'), $listing->bedrooms )  }}
                    >{{ $x }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="beds">Beds</label>
            <select name="beds" id="beds" class="form-control">
                @for( $x = 0; $x <= 10; $x++)
                <option 
                    value="{{ $x }}" 
                    {{ Helper::setSelectedOption( $x, old('beds'), $listing->beds )  }}
                    >{{ $x }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="baths">Baths</label>
            <select name="baths" id="baths" class="form-control">
                @for( $x = 0; $x <= 10; $x++)
                <option 
                    value="{{ $x }}" 
                    {{ Helper::setSelectedOption( $x, old('baths'), $listing->baths )  }}
                    >{{ $x }}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="descripton">Description</label>
            <textarea 
                name="description" 
                id="description"
                class="form-control"
                rows="10"
                >{{ Helper::displayInputValue( old('description'), $listing->description )}}</textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="rules">Rules</label>
            <textarea 
                name="rules" 
                id="rules"
                class="form-control"
                rows="3"
                >{{ Helper::displayInputValue( old('rules'), $listing->rules )}}</textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="cancellation">Cancellation</label>
            <textarea 
                name="cancellation" 
                id="cancellation"
                class="form-control"
                rows="3"
                >{{ Helper::displayInputValue( old('cancellation'), $listing->cancellation )}}</textarea>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 text-right">
            <a href="{{ route('profile.listings.index')}} " class="btn btn-secondary">Cancel</a>
            <button class="btn btn-primary">Save</button>
        </div>
    </div>
</form>