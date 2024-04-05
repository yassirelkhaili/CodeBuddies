<section>
<form action="{{ route("skill.update") }}" method="post" class="space-y-6">
  @csrf
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Add Skills') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Here you can add your most relevent skills to get personalized job recommendations.') }}
    </p>
</header>

<div>
<div id="skill-input" class="p-2.5 rounded-lg flex flex-wrap justify-start items-center bg-gray-50 border border-gray-300 text-gray-900 text-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none">
@foreach ($skills as $skill)
          <div class='px-1'>
                  <div class='dark:bg-primary-900 flex justify-center items-center rounded gap-1 py-1 px-2 text-primary-300 mt-1'>
                  <span class="text-xs font-medium text-primary-300">{{$skill}}</span>
                  <button type="button" class="skill-button">
                  <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#FFFFFFF" viewBox="0 0 14 14">
                      <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  </button>
                  </div>
              </div>
              @endforeach
</div>
</div>
<div>
  <select name="skill" id="skill" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
@forelse ($availableSkills as $index => $availableSkill)
@if ($index === 0)
<option selected disabled>Select skills</option>
    @else
    <option value={{$availableSkill->id}} >{{$availableSkill->name}}</option>
@endif
@empty
<option selected disabled>no skill is available at this moment</option>
@endforelse
</select></div>
<input type="hidden" name="skills" value={{ $skills->implode(',') }}>
  @session("success")
<x-input-success :messages="$value" class="mt-2" />
@endsession
<button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
  Save
</button>
</form>
</section>