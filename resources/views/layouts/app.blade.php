<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="200x200" href="{{ asset('assets/assets/img/Logo-Pw.png') }}">
        <link rel="icon" type="image/png" sizes="200x200" href="{{ asset('assets/assets/img/Logo-Pw.png') }}">
        <title>
            {{ $title }}
        </title>
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Nucleo Icons -->
        <link href="{{ asset('assets/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="{{ asset('assets/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('assets/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @stack('head')
        <style>


            /* Style for the button container */
            .modal {
              overflow: auto !important;
            }
            .button-container {
              display: inline-block; /* Make it inline to fit the content */
            }


            /* Style for the button */
            .custom-button {
              padding: 4.1px 12px; /* Adjust padding as needed */
              font-size: 14px; /* Adjust font size as needed */
              background-color: #007bff; /* Button background color */
              color: #fff; /* Button text color */
              border: none; /* Remove border for a clean look */
              border-radius: 8px; /* Add border-radius for rounded corners */
              cursor: pointer;
              transition: background-color 0.3s ease; /* Add transition for a smooth hover effect */
            }

            /* Hover effect */
            .custom-button:hover {
              background-color: #0056b3; /* Change background color on hover */
            }

            .custom-button-delete {
              padding: 2px 8px; /* Adjust padding as needed */
              font-size: 14px; /* Adjust font size as needed */
              background-color: #ff0000; /* Button background color */
              color: #fff; /* Button text color */
              border: none; /* Remove border for a clean look */
              border-radius: 8px; /* Add border-radius for rounded corners */
              cursor: pointer;
              transition: background-color 0.3s ease; /* Add transition for a smooth hover effect */
            }

            /* Hover effect */
            .custom-button-delete:hover {
              background-color: #ca0000; /* Change background color on hover */
            }

            .custom-button-cancel {
                padding: 2px 8px; /* Adjust padding as needed */
                font-size: 14px; /* Adjust font size as needed */
                background-color: #f9bc2fc2; /* Button background color */
                color: #fff; /* Button text color */
                border: none; /* Remove border for a clean look */
                border-radius: 8px; /* Add border-radius for rounded corners */
                cursor: pointer;
                transition: background-color 0.3s ease; /* Add transition for a smooth hover effect */
              }

              /* Hover effect */
              .custom-button-cancel:hover {
                background-color: #be7602eb; /* Change background color on hover */
              }

            .custom-button-booking {
              padding: 2px 8px; /* Adjust padding as needed */
              font-size: 14px; /* Adjust font size as needed */
              background-color: #2b5bfa; /* Button background color */
              color: #fff; /* Button text color */
              border: none; /* Remove border for a clean look */
              border-radius: 8px; /* Add border-radius for rounded corners */
              cursor: pointer;
              transition: background-color 0.3s ease; /* Add transition for a smooth hover effect */
            }

            /* Hover effect */
            .custom-button-booking:hover {
              background-color: #0508dd; /* Change background color on hover */
            }

            .custom-button-checkout {
              padding: 2px 8px; /* Adjust padding as needed */
              font-size: 14px; /* Adjust font size as needed */
              background-color: #00ff22; /* Button background color */
              color: #fff; /* Button text color */
              border: none; /* Remove border for a clean look */
              border-radius: 8px; /* Add border-radius for rounded corners */
              cursor: pointer;
              transition: background-color 0.3s ease; /* Add transition for a smooth hover effect */
            }

            /* Hover effect */
            .custom-button-checkout:hover {
              background-color: #10c400; /* Change background color on hover */
            }

            .custom-button-detail {
              padding: 2px 8px; /* Adjust padding as needed */
              font-size: 14px; /* Adjust font size as needed */
              background-color: #11cdef; /* Button background color */
              color: #fff; /* Button text color */
              border: none; /* Remove border for a clean look */
              border-radius: 8px; /* Add border-radius for rounded corners */
              cursor: pointer;
              transition: background-color 0.3s ease; /* Add transition for a smooth hover effect */
            }

            /* Hover effect */
            .custom-button-detail:hover {
              background-color: #0fa1bb; /* Change background color on hover */
            }

            .custom-button-invoice {
              padding: 2px 8px; /* Adjust padding as needed */
              font-size: 14px; /* Adjust font size as needed */
              background-color: #ffc107; /* Button background color */
              color: #fff; /* Button text color */
              border: none; /* Remove border for a clean look */
              border-radius: 8px; /* Add border-radius for rounded corners */
              cursor: pointer;
              transition: background-color 0.3s ease; /* Add transition for a smooth hover effect */
            }

            /* Hover effect */
            .custom-button-invoice:hover {
              background-color: #ca9a0a; /* Change background color on hover */
            }
            /* CSS untuk menghilangkan background gelap pada modal */
            .modal.no-backdrop .modal-backdrop {
                background-color: transparent;
            }

            .modal.no-backdrop::backdrop {
                background-color: transparent;
            }


          </style>
    </head>

    <body class="g-sidenav-show   bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>

        @include('sweetalert::alert')

        @include('layouts.sidenav')

        @yield('content')

        @include('layouts.script')

    </body>

</html>
