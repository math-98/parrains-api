@extends('errors.layout')

@section('title', "Accès interdit")

@section('code', '403')
@section('message', $exception->getMessage() ?: "Vous n'avez pas le droit d'accéder à cette ressource")
