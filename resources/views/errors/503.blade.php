@extends('errors.layout')

@section('title', "Maintenance")

@section('code', '503')
@section('message', $exception->getMessage() ?: "Le site est actuellement en mode maintenance, merci de revenir plus tard")
