@extends('admin.layouts.admin')

@section('title', 'Upload Timetable - Time Table Management')

@section('content')
<div class="upload-tt-container">
    <div class="upload-tt-header">
        <h1><i class="fas fa-upload"></i> Upload Timetable</h1>
        <p>Upload your timetable data in pdf format</p>
    </div>

    <div class="upload-tt-content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('upload_ttm_data') }}" method="POST" enctype="multipart/form-data" class="upload-tt-form">
            @csrf
            <div class="form-group">
                <label for="csv_file">
                    <i class="fas fa-file-csv"></i>
                    Select pdf File
                </label>
                <input type="file" name="pdf" id="pdf" class="form-control @error('pdf') is-invalid @enderror" accept=".pdf" required>
                @error('pdf')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="semester">
                    <i class="fas fa-calendar-alt"></i>
                    Select Semester
                </label>
                <select name="sem" id="sem" class="form-control @error('sem') is-invalid @enderror" required>
                    <option value="">Choose a semester</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}">Semester {{ $i }}</option>
                    @endfor
                </select>
                @error('semester')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="csv_file">
                    <i class="fas fa-file-csv"></i>
                    Description
                </label>
                <input type="text" name="description" id="description" required>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="csv_file">
                    <i class="fas fa-file-csv"></i>
                    Select Date
                </label>
                <input type="date" name="date" id="date" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-upload">
                <i class="fas fa-upload"></i>
                Upload Timetable
            </button>
        </form>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/upload_tt.css') }}">
@endsection

<style>

.adname
{
  margin-left:18px;
  margin-top:21px;
}
img
{
  width:80px;
  height:83px;
  border-radius:60px;
  margin-left:10px;
}
.namediv
{
  display:flex;
}
* {
      box-sizing: border-box;
      font-family: 'Public Sans', sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background: linear-gradient(to right, #f1f4f9, #dff1ff);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .upload-form-container {
      background: #ffffff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }

    .upload-form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-weight: 600;
      font-size: 15px;
      color: #34495e;
      display: block;
      margin-bottom: 8px;
    }

    input[type="file"],
    select,
    input[type="date"],
    textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    input[type="file"]:focus,
    select:focus,
    input[type="date"]:focus,
    textarea:focus {
      border-color: #1e88e5;
      outline: none;
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background: linear-gradient(to right, #1e88e5, #5e35b1);
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
    }

    .submit-btn:hover {
      background: linear-gradient(to right, #ffee58, #66bb6a);
      transform: translateY(-2px);
    }

    .submit-btn:active {
      background: linear-gradient(to right, #66bb6a, #aed581);
      transform: translateY(2px);
    }

    @media (max-width: 600px) {
      .upload-form-container {
        padding: 20px;
      }
    }
    .upload-form-container
    {
        width:100%;
    }

</style>
         
        

      
       