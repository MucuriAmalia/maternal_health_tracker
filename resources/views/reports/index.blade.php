<x-app-layout>

<x-slot name="header">
<h2 class="text-2xl font-bold">Reports Dashboard</h2>
</x-slot>

<div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

<a href="{{ route('reports.anc') }}" class="bg-white shadow rounded-xl p-6 hover:bg-gray-50">
<h3 class="font-bold text-lg">ANC Attendance</h3>
<p class="text-sm text-gray-500">Antenatal clinic visits report</p>
</a>

<a href="{{ route('reports.expected') }}" class="bg-white shadow rounded-xl p-6 hover:bg-gray-50">
<h3 class="font-bold text-lg">Expected Deliveries</h3>
<p class="text-sm text-gray-500">Upcoming deliveries</p>
</a>

<a href="{{ route('reports.highrisk') }}" class="bg-white shadow rounded-xl p-6 hover:bg-gray-50">
<h3 class="font-bold text-lg">High Risk Pregnancies</h3>
<p class="text-sm text-gray-500">Monitor high risk mothers</p>
</a>

<a href="{{ route('reports.delivery') }}" class="bg-white shadow rounded-xl p-6 hover:bg-gray-50">
<h3 class="font-bold text-lg">Delivery Outcomes</h3>
<p class="text-sm text-gray-500">Birth outcomes analysis</p>
</a>

<a href="{{ route('reports.supplements') }}" class="bg-white shadow rounded-xl p-6 hover:bg-gray-50">
<h3 class="font-bold text-lg">Supplement Usage</h3>
<p class="text-sm text-gray-500">Iron / folic acid distribution</p>
</a>

</div>

</x-app-layout>