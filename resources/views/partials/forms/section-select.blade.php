<div class="form-group">
    <label for="section_id">Section</label>
    <select name="section_id" class="form-control">
        @if(Auth::user()->role->scope === 'section')
            <option value="{{ Auth::user()->person->section->id }}" selected>{{ Auth::user()->person->section->name }}</option>
        @else
            @foreach(\App\Section::all() as $section)
                <option
                    value="{{ $section->id }}"
                    @if(session('section_id') === $section->id)
                        selected
                    @endif
                >
                    {{ $section->name }}
                </option>
            @endforeach
        @endif
    </select>
</div>