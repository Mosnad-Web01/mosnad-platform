<x-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <!-- Dashboard Content -->
    <div class="min-h-screen bg-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8" dir="ltr">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Welcome to Dashboard</h1>
                        <p class="mt-2 text-gray-600">Here's your platform overview</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fas fa-chart-line text-5xl text-indigo-500"></i>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Job Opportunities Card -->
                <div
                    class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold opacity-80">Job Opportunities</p>
                            <h2 class="text-4xl font-bold mt-2">{{ $opportunities }}</h2>
                        </div>
                        <div class="bg-blue-400 bg-opacity-30 rounded-full p-4">
                            <i class="fas fa-briefcase text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Bootcamps Card -->
                <div
                    class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold opacity-80">Bootcamps</p>
                            <h2 class="text-4xl font-bold mt-2">{{ $bootcamps }}</h2>
                        </div>
                        <div class="bg-purple-400 bg-opacity-30 rounded-full p-4">
                            <i class="fas fa-laptop-code text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Users Card -->
                <div
                    class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white transform hover:scale-105 transition-transform duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold opacity-80">Total Users</p>
                            <h2 class="text-4xl font-bold mt-2">{{ $users }}</h2>
                        </div>
                        <div class="bg-green-400 bg-opacity-30 rounded-full p-4">
                            <i class="fas fa-users text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surveys and Contact Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Youth Surveys Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:shadow-xl transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Youth Surveys</h3>
                        <i class="fas fa-poll text-2xl text-orange-500"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-700">{{ $youthSurveys }}</div>
                    <div class="mt-2 text-sm text-gray-600">Total submissions</div>
                </div>

                <!-- Company Surveys Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:shadow-xl transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Company Surveys</h3>
                        <i class="fas fa-building text-2xl text-blue-500"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-700">{{ $companySurveys }}</div>
                    <div class="mt-2 text-sm text-gray-600">Total responses</div>
                </div>

                <!-- Contact Messages Card -->
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:shadow-xl transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">Contact Messages</h3>
                        <i class="fas fa-envelope text-2xl text-purple-500"></i>
                    </div>
                    <div class="text-3xl font-bold text-gray-700">{{ $contactUs }}</div>
                    <div class="mt-2 text-sm text-gray-600">Total messages</div>
                </div>
            </div>



            <!-- Charts Section -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- User Growth Chart -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                            Platform Growth
                        </h3>
                        <div class="flex space-x-2">
                            <button onclick="updateTimeRange('weekly')"
                                class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200">Weekly</button>
                            <button onclick="updateTimeRange('monthly')"
                                class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-full hover:bg-blue-200">Monthly</button>
                        </div>
                    </div>
                    <canvas id="userGrowthChart" class="w-full" height="300"></canvas>
                </div>

                <!-- Distribution Pie Chart -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            <i class="fas fa-chart-pie text-purple-500 mr-2"></i>
                            Platform Distribution
                        </h3>
                    </div>
                    <canvas id="distributionChart" class="w-full" height="300"></canvas>
                </div>

                <!-- Survey Responses Timeline -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            <i class="fas fa-poll text-green-500 mr-2"></i>
                            Survey Responses Timeline
                        </h3>
                    </div>
                    <canvas id="surveyTimelineChart" class="w-full" height="300"></canvas>
                </div>

                <!-- Job Categories Distribution -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-800">
                            <i class="fas fa-briefcase text-orange-500 mr-2"></i>
                            Job Categories
                        </h3>
                    </div>
                    <canvas id="jobCategoriesChart" class="w-full" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>


    <!-- Add required CDNs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <script>
        // User Growth Chart
        const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        new Chart(userGrowthCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Users',
                    data: [65, 78, 90, 115, 145, 170],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Distribution Pie Chart
        const distributionCtx = document.getElementById('distributionChart').getContext('2d');
        new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Job Opportunities', 'Bootcamps', 'Youth Surveys', 'Company Surveys'],
                datasets: [{
                    data: [{{ $opportunities }}, {{ $bootcamps }}, {{ $youthSurveys }}, {{ $companySurveys }}],
                    backgroundColor: [
                        '#3B82F6',
                        '#8B5CF6',
                        '#10B981',
                        '#F59E0B'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Survey Timeline Chart
        const surveyTimelineCtx = document.getElementById('surveyTimelineChart').getContext('2d');
        new Chart(surveyTimelineCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Youth Surveys',
                    data: [30, 45, 35, 50, 40, 60],
                    backgroundColor: '#10B981'
                }, {
                    label: 'Company Surveys',
                    data: [20, 35, 25, 40, 30, 45],
                    backgroundColor: '#F59E0B'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Job Categories Chart
        const jobCategoriesCtx = document.getElementById('jobCategoriesChart').getContext('2d');
        new Chart(jobCategoriesCtx, {
            type: 'polarArea',
            data: {
                labels: ['Technology', 'Marketing', 'Finance', 'Design', 'Sales'],
                datasets: [{
                    data: [45, 25, 20, 30, 35],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(239, 68, 68, 0.7)'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Function to update time range (you can implement the logic)
        function updateTimeRange(range) {
            // Add logic to update chart data based on selected time range
            console.log(`Updating to ${range} view`);
        }
    </script>
</x-layout>
