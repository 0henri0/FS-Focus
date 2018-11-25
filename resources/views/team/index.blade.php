@extends('layouts.app')

@section('styles')
<style>
.noUi-target,
.noUi-target * {
  -webkit-touch-callout: none;
  -webkit-tap-highlight-color: transparent;
  -webkit-user-select: none;
  -ms-touch-action: none;
  touch-action: none;
  -ms-user-select: none;
  -moz-user-select: none;
  user-select: none;
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

.noUi-target {
  position: relative;
  direction: ltr;
}

.noUi-base {
  width: 100%;
  height: 100%;
  position: relative;
  z-index: 1;
  /* Fix 401 */
}

.noUi-connect {
  position: absolute;
  right: 0;
  top: 0;
  left: 0;
  bottom: 0;
}

.noUi-origin {
  position: absolute;
  height: 0;
  width: 0;
}

.noUi-handle {
  position: relative;
  z-index: 1;
}

.noUi-state-tap .noUi-connect,
.noUi-state-tap .noUi-origin {
  -webkit-transition: top 0.3s, right 0.3s, bottom 0.3s, left 0.3s;
  transition: top 0.3s, right 0.3s, bottom 0.3s, left 0.3s;
}

.noUi-state-drag * {
  cursor: inherit !important;
}

/* Painting and performance;
 * Browsers can paint handles in their own layer.
 */
.noUi-base,
.noUi-handle {
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}

/* Slider size and handle placement;
 */
.noUi-horizontal {
  height: 1px;
}

.noUi-horizontal .noUi-handle {
  border-radius: 50%;
  background-color: #FFFFFF;
  -webkit-box-shadow: 0 1px 13px 0 rgba(0, 0, 0, 0.2);
          box-shadow: 0 1px 13px 0 rgba(0, 0, 0, 0.2);
  height: 15px;
  width: 15px;
  cursor: pointer;
  margin-left: -10px;
  margin-top: -7px;
}

.noUi-vertical {
  width: 18px;
}

.noUi-vertical .noUi-handle {
  width: 28px;
  height: 34px;
  left: -6px;
  top: -17px;
}

/* Styling;
 */
.noUi-target {
  background-color: rgba(182, 182, 182, 0.3);
  border-radius: 3px;
}

.noUi-connect {
  background: #888;
  border-radius: 3px;
  -webkit-transition: background 450ms;
  transition: background 450ms;
}

/* Handles and cursors;
 */
.noUi-draggable {
  cursor: ew-resize;
}

.noUi-vertical .noUi-draggable {
  cursor: ns-resize;
}

.noUi-handle {
  border-radius: 3px;
  background: #FFF;
  cursor: default;
  -webkit-box-shadow: inset 0 0 1px #FFF,
 inset 0 1px 7px #EBEBEB,
 0 3px 6px -3px #BBB;
          box-shadow: inset 0 0 1px #FFF,
 inset 0 1px 7px #EBEBEB,
 0 3px 6px -3px #BBB;
  -webkit-transition: 300ms ease 0s;
  -moz-transition: 300ms ease 0s;
  -ms-transition: 300ms ease 0s;
  -o-transform: 300ms ease 0s;
  transition: 300ms ease 0s;
}

.noUi-active {
  -webkit-transform: scale3d(1.5, 1.5, 1);
  transform: scale3d(1.5, 1.5, 1);
}

/* Disabled state;
 */
[disabled] .noUi-connect {
  background: #B8B8B8;
}

[disabled].noUi-target,
[disabled].noUi-handle,
[disabled] .noUi-handle {
  cursor: not-allowed;
}

/* Base;
 *
 */
.noUi-pips,
.noUi-pips * {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
}

.noUi-pips {
  position: absolute;
  color: #999;
}

/* Values;
 *
 */
.noUi-value {
  position: absolute;
  text-align: center;
}

.noUi-value-sub {
  color: #ccc;
  font-size: 10px;
}

/* Markings;
 *
 */
.noUi-marker {
  position: absolute;
  background: #CCC;
}

.noUi-marker-sub {
  background: #AAA;
}

.noUi-marker-large {
  background: #AAA;
}

/* Horizontal layout;
 *
 */
.noUi-pips-horizontal {
  padding: 10px 0;
  height: 80px;
  top: 100%;
  left: 0;
  width: 100%;
}

.noUi-value-horizontal {
  -webkit-transform: translate3d(-50%, 50%, 0);
  transform: translate3d(-50%, 50%, 0);
}

.noUi-marker-horizontal.noUi-marker {
  margin-left: -1px;
  width: 2px;
  height: 5px;
}

.noUi-marker-horizontal.noUi-marker-sub {
  height: 10px;
}

.noUi-marker-horizontal.noUi-marker-large {
  height: 15px;
}

/* Vertical layout;
 *
 */
.noUi-pips-vertical {
  padding: 0 10px;
  height: 100%;
  top: 0;
  left: 100%;
}

.noUi-value-vertical {
  -webkit-transform: translate3d(0, 50%, 0);
  transform: translate3d(0, 50%, 0);
  padding-left: 25px;
}

.noUi-marker-vertical.noUi-marker {
  width: 5px;
  height: 2px;
  margin-top: -1px;
}

.noUi-marker-vertical.noUi-marker-sub {
  width: 10px;
}

.noUi-marker-vertical.noUi-marker-large {
  width: 15px;
}

.noUi-tooltip {
  display: block;
  position: absolute;
  border: 1px solid #D9D9D9;
  border-radius: 3px;
  background: #fff;
  color: #000;
  padding: 5px;
  text-align: center;
}

.noUi-horizontal .noUi-tooltip {
  -webkit-transform: translate(-50%, 0);
  transform: translate(-50%, 0);
  left: 50%;
  bottom: 120%;
}

.noUi-vertical .noUi-tooltip {
  -webkit-transform: translate(0, -50%);
  transform: translate(0, -50%);
  top: 50%;
  right: 120%;
}

.slider.slider-neutral .noUi-connect, .slider.slider-neutral.noUi-connect {
  background-color: #FFFFFF;
}

.slider.slider-neutral.noUi-target {
  background-color: rgba(255, 255, 255, 0.3);
}

.slider.slider-neutral .noUi-handle {
  background-color: #FFFFFF;
}

.slider.slider-primary .noUi-connect, .slider.slider-primary.noUi-connect {
  background-color: #378C3F;
}

.slider.slider-primary.noUi-target {
  background-color: rgba(55, 140, 63, 0.4);
}

.slider.slider-primary .noUi-handle {
  background-color: #378C3F;
}

.slider.slider-info .noUi-connect, .slider.slider-info.noUi-connect {
  background-color: #2CA8FF;
}

.slider.slider-info.noUi-target {
  background-color: rgba(44, 168, 255, 0.3);
}

.slider.slider-info .noUi-handle {
  background-color: #2CA8FF;
}

.slider.slider-success .noUi-connect, .slider.slider-success.noUi-connect {
  background-color: #18ce0f;
}

.slider.slider-success.noUi-target {
  background-color: rgba(24, 206, 15, 0.3);
}

.slider.slider-success .noUi-handle {
  background-color: #18ce0f;
}

.slider.slider-warning .noUi-connect, .slider.slider-warning.noUi-connect {
  background-color: #FFB236;
}

.slider.slider-warning.noUi-target {
  background-color: rgba(255, 178, 54, 0.3);
}

.slider.slider-warning .noUi-handle {
  background-color: #FFB236;
}

.slider.slider-danger .noUi-connect, .slider.slider-danger.noUi-connect {
  background-color: #FF3636;
}

.slider.slider-danger.noUi-target {
  background-color: rgba(255, 54, 54, 0.3);
}

.slider.slider-danger .noUi-handle {
  background-color: #FF3636;
}

/*!
 * Datepicker for Bootstrap v1.7.0-dev (https://github.com/uxsolutions/bootstrap-datepicker)
 *
 * Licensed under the Apache License v2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */
.datepicker {
  padding: 8px 6px;
  border-radius: 4px;
  direction: ltr;
  -webkit-transform: translate3d(0, -40px, 0);
  transform: translate3d(0, -40px, 0);
  -webkit-transition: all 0.3s cubic-bezier(0.215, 0.61, 0.355, 1) 0s, opacity 0.3s ease 0s, height 0s linear 0.35s;
  transition: all 0.3s cubic-bezier(0.215, 0.61, 0.355, 1) 0s, opacity 0.3s ease 0s, height 0s linear 0.35s;
  opacity: 0;
  filter: alpha(opacity=0);
  visibility: hidden;
  display: block;
  width: 254px;
  max-width: 254px;
}

.datepicker.dropdown-menu:before {
  display: none;
}

.datepicker.datepicker-primary {
  background-color: #378C3F;
}

.datepicker.datepicker-primary th,
.datepicker.datepicker-primary .day div,
.datepicker.datepicker-primary table tr td span {
  color: #FFFFFF;
}

.datepicker.datepicker-primary:after {
  border-bottom-color: #378C3F;
}

.datepicker.datepicker-primary.datepicker-orient-top:after {
  border-top-color: #378C3F;
}

.datepicker.datepicker-primary .dow {
  color: rgba(255, 255, 255, 0.8);
}

.datepicker.datepicker-primary table tr td.old div,
.datepicker.datepicker-primary table tr td.new div,
.datepicker.datepicker-primary table tr td span.old,
.datepicker.datepicker-primary table tr td span.new {
  color: rgba(255, 255, 255, 0.4);
}

.datepicker.datepicker-primary table tr td span:hover,
.datepicker.datepicker-primary table tr td span.focused {
  background: rgba(255, 255, 255, 0.1);
}

.datepicker.datepicker-primary .datepicker-switch:hover,
.datepicker.datepicker-primary .prev:hover,
.datepicker.datepicker-primary .next:hover,
.datepicker.datepicker-primary tfoot tr th:hover {
  background: rgba(255, 255, 255, 0.2);
}

.datepicker.datepicker-primary table tr td.active div,
.datepicker.datepicker-primary table tr td.active:hover div,
.datepicker.datepicker-primary table tr td.active.disabled div,
.datepicker.datepicker-primary table tr td.active.disabled:hover div {
  background-color: #FFFFFF;
  color: #378C3F;
}

.datepicker.datepicker-primary table tr td.day:hover div,
.datepicker.datepicker-primary table tr td.day.focused div {
  background: rgba(255, 255, 255, 0.2);
}

.datepicker.datepicker-primary table tr td.active:hover div,
.datepicker.datepicker-primary table tr td.active:hover:hover div,
.datepicker.datepicker-primary table tr td.active.disabled:hover div,
.datepicker.datepicker-primary table tr td.active.disabled:hover:hover div,
.datepicker.datepicker-primary table tr td.active:active div,
.datepicker.datepicker-primary table tr td.active:hover:active div,
.datepicker.datepicker-primary table tr td.active.disabled:active div,
.datepicker.datepicker-primary table tr td.active.disabled:hover:active div,
.datepicker.datepicker-primary table tr td.active.active div,
.datepicker.datepicker-primary table tr td.active:hover.active div,
.datepicker.datepicker-primary table tr td.active.disabled.active div,
.datepicker.datepicker-primary table tr td.active.disabled:hover.active div,
.datepicker.datepicker-primary table tr td.active.disabled div,
.datepicker.datepicker-primary table tr td.active:hover.disabled div,
.datepicker.datepicker-primary table tr td.active.disabled.disabled div,
.datepicker.datepicker-primary table tr td.active.disabled:hover.disabled div,
.datepicker.datepicker-primary table tr td.active[disabled] div,
.datepicker.datepicker-primary table tr td.active:hover[disabled] div,
.datepicker.datepicker-primary table tr td.active.disabled[disabled] div,
.datepicker.datepicker-primary table tr td.active.disabled:hover[disabled] div,
.datepicker.datepicker-primary table tr td span.active:hover,
.datepicker.datepicker-primary table tr td span.active:hover:hover,
.datepicker.datepicker-primary table tr td span.active.disabled:hover,
.datepicker.datepicker-primary table tr td span.active.disabled:hover:hover,
.datepicker.datepicker-primary table tr td span.active:active,
.datepicker.datepicker-primary table tr td span.active:hover:active,
.datepicker.datepicker-primary table tr td span.active.disabled:active,
.datepicker.datepicker-primary table tr td span.active.disabled:hover:active,
.datepicker.datepicker-primary table tr td span.active.active,
.datepicker.datepicker-primary table tr td span.active:hover.active,
.datepicker.datepicker-primary table tr td span.active.disabled.active,
.datepicker.datepicker-primary table tr td span.active.disabled:hover.active,
.datepicker.datepicker-primary table tr td span.active.disabled,
.datepicker.datepicker-primary table tr td span.active:hover.disabled,
.datepicker.datepicker-primary table tr td span.active.disabled.disabled,
.datepicker.datepicker-primary table tr td span.active.disabled:hover.disabled,
.datepicker.datepicker-primary table tr td span.active[disabled],
.datepicker.datepicker-primary table tr td span.active:hover[disabled],
.datepicker.datepicker-primary table tr td span.active.disabled[disabled],
.datepicker.datepicker-primary table tr td span.active.disabled:hover[disabled] {
  background-color: #FFFFFF;
}

.datepicker.datepicker-primary table tr td span.active:hover,
.datepicker.datepicker-primary table tr td span.active:hover:hover,
.datepicker.datepicker-primary table tr td span.active.disabled:hover,
.datepicker.datepicker-primary table tr td span.active.disabled:hover:hover,
.datepicker.datepicker-primary table tr td span.active:active,
.datepicker.datepicker-primary table tr td span.active:hover:active,
.datepicker.datepicker-primary table tr td span.active.disabled:active,
.datepicker.datepicker-primary table tr td span.active.disabled:hover:active,
.datepicker.datepicker-primary table tr td span.active.active,
.datepicker.datepicker-primary table tr td span.active:hover.active,
.datepicker.datepicker-primary table tr td span.active.disabled.active,
.datepicker.datepicker-primary table tr td span.active.disabled:hover.active,
.datepicker.datepicker-primary table tr td span.active.disabled,
.datepicker.datepicker-primary table tr td span.active:hover.disabled,
.datepicker.datepicker-primary table tr td span.active.disabled.disabled,
.datepicker.datepicker-primary table tr td span.active.disabled:hover.disabled,
.datepicker.datepicker-primary table tr td span.active[disabled],
.datepicker.datepicker-primary table tr td span.active:hover[disabled],
.datepicker.datepicker-primary table tr td span.active.disabled[disabled],
.datepicker.datepicker-primary table tr td span.active.disabled:hover[disabled] {
  color: #378C3F;
}

.datepicker-inline {
  width: 220px;
}

.datepicker.datepicker-rtl {
  direction: rtl;
}

.datepicker.datepicker-rtl.dropdown-menu {
  left: auto;
}

.datepicker.datepicker-rtl table tr td span {
  float: right;
}

.datepicker-dropdown {
  top: 0;
  left: 0;
}

.datepicker-dropdown:before {
  content: '';
  display: inline-block;
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  border-bottom: 7px solid transparent;
  border-top: 0;
  border-bottom-color: rgba(0, 0, 0, 0.2);
  position: absolute;
}

.datepicker-dropdown:after {
  content: '';
  display: inline-block;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #fff;
  border-top: 0;
  position: absolute;
}

.datepicker-dropdown.datepicker-orient-left:before {
  left: 6px;
}

.datepicker-dropdown.datepicker-orient-left:after {
  left: 7px;
}

.datepicker-dropdown.datepicker-orient-right:before {
  right: 6px;
}

.datepicker-dropdown.datepicker-orient-right:after {
  right: 7px;
}

.datepicker-dropdown.datepicker-orient-bottom:before {
  top: -7px;
}

.datepicker-dropdown.datepicker-orient-bottom:after {
  top: -6px;
}

.datepicker-dropdown.datepicker-orient-top:before {
  bottom: -7px;
  border-bottom: 0;
  border-top: 7px solid transparent;
}

.datepicker-dropdown.datepicker-orient-top:after {
  bottom: -6px;
  border-bottom: 0;
  border-top: 6px solid #fff;
}

.datepicker table {
  margin: 0;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  width: 241px;
  max-width: 241px;
}

.datepicker .day div,
.datepicker th {
  -webkit-transition: all 300ms ease 0s;
  transition: all 300ms ease 0s;
  text-align: center;
  width: 30px;
  height: 30px;
  line-height: 2.2;
  border-radius: 50%;
  font-weight: 300;
  font-size: 14px;
  border: none;
  position: relative;
  cursor: pointer;
}

.datepicker th {
  color: #378C3F;
}

.table-condensed > tbody > tr > td,
.table-condensed > tbody > tr > th,
.table-condensed > tfoot > tr > td,
.table-condensed > tfoot > tr > th,
.table-condensed > thead > tr > td,
.table-condensed > thead > tr > th {
  padding: 2px;
  text-align: center;
  cursor: pointer;
}

.table-striped .datepicker table tr td,
.table-striped .datepicker table tr th {
  background-color: transparent;
}

.datepicker table tr td.day:hover div,
.datepicker table tr td.day.focused div {
  background: #eee;
  cursor: pointer;
}

.datepicker table tr td.old,
.datepicker table tr td.new {
  color: #888;
}

.datepicker table tr td.disabled,
.datepicker table tr td.disabled:hover {
  background: none;
  color: #888;
  cursor: default;
}

.datepicker table tr td.highlighted {
  background: #d9edf7;
  border-radius: 0;
}

.datepicker table tr td.today,
.datepicker table tr td.today:hover,
.datepicker table tr td.today.disabled,
.datepicker table tr td.today.disabled:hover {
  background-color: #fde19a;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#fdd49a), to(#fdf59a));
  background-image: linear-gradient(to bottom, #fdd49a, #fdf59a);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fdd49a', endColorstr='#fdf59a', GradientType=0);
  border-color: #fdf59a #fdf59a #fbed50;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  color: #000;
}

.datepicker table tr td.today:hover,
.datepicker table tr td.today:hover:hover,
.datepicker table tr td.today.disabled:hover,
.datepicker table tr td.today.disabled:hover:hover,
.datepicker table tr td.today:active,
.datepicker table tr td.today:hover:active,
.datepicker table tr td.today.disabled:active,
.datepicker table tr td.today.disabled:hover:active,
.datepicker table tr td.today.active,
.datepicker table tr td.today:hover.active,
.datepicker table tr td.today.disabled.active,
.datepicker table tr td.today.disabled:hover.active,
.datepicker table tr td.today.disabled,
.datepicker table tr td.today:hover.disabled,
.datepicker table tr td.today.disabled.disabled,
.datepicker table tr td.today.disabled:hover.disabled,
.datepicker table tr td.today[disabled],
.datepicker table tr td.today:hover[disabled],
.datepicker table tr td.today.disabled[disabled],
.datepicker table tr td.today.disabled:hover[disabled] {
  background-color: #fdf59a;
}

.datepicker table tr td.today:active,
.datepicker table tr td.today:hover:active,
.datepicker table tr td.today.disabled:active,
.datepicker table tr td.today.disabled:hover:active,
.datepicker table tr td.today.active,
.datepicker table tr td.today:hover.active,
.datepicker table tr td.today.disabled.active,
.datepicker table tr td.today.disabled:hover.active {
  background-color: #fbf069 \9;
}

.datepicker table tr td.today:hover:hover {
  color: #000;
}

.datepicker table tr td.today.active:hover {
  color: #fff;
}

.datepicker table tr td.range,
.datepicker table tr td.range:hover,
.datepicker table tr td.range.disabled,
.datepicker table tr td.range.disabled:hover {
  background: #eee;
  border-radius: 0;
}

.datepicker table tr td.range.today,
.datepicker table tr td.range.today:hover,
.datepicker table tr td.range.today.disabled,
.datepicker table tr td.range.today.disabled:hover {
  background-color: #f3d17a;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#f3c17a), to(#f3e97a));
  background-image: linear-gradient(to bottom, #f3c17a, #f3e97a);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f3c17a', endColorstr='#f3e97a', GradientType=0);
  border-color: #f3e97a #f3e97a #edde34;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  border-radius: 0;
}

.datepicker table tr td.range.today:hover,
.datepicker table tr td.range.today:hover:hover,
.datepicker table tr td.range.today.disabled:hover,
.datepicker table tr td.range.today.disabled:hover:hover,
.datepicker table tr td.range.today:active,
.datepicker table tr td.range.today:hover:active,
.datepicker table tr td.range.today.disabled:active,
.datepicker table tr td.range.today.disabled:hover:active,
.datepicker table tr td.range.today.active,
.datepicker table tr td.range.today:hover.active,
.datepicker table tr td.range.today.disabled.active,
.datepicker table tr td.range.today.disabled:hover.active,
.datepicker table tr td.range.today.disabled,
.datepicker table tr td.range.today:hover.disabled,
.datepicker table tr td.range.today.disabled.disabled,
.datepicker table tr td.range.today.disabled:hover.disabled,
.datepicker table tr td.range.today[disabled],
.datepicker table tr td.range.today:hover[disabled],
.datepicker table tr td.range.today.disabled[disabled],
.datepicker table tr td.range.today.disabled:hover[disabled] {
  background-color: #f3e97a;
}

.datepicker table tr td.range.today:active,
.datepicker table tr td.range.today:hover:active,
.datepicker table tr td.range.today.disabled:active,
.datepicker table tr td.range.today.disabled:hover:active,
.datepicker table tr td.range.today.active,
.datepicker table tr td.range.today:hover.active,
.datepicker table tr td.range.today.disabled.active,
.datepicker table tr td.range.today.disabled:hover.active {
  background-color: #efe24b \9;
}

.datepicker table tr td.selected,
.datepicker table tr td.selected:hover,
.datepicker table tr td.selected.disabled,
.datepicker table tr td.selected.disabled:hover {
  background-color: #9e9e9e;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#b3b3b3), to(#808080));
  background-image: linear-gradient(to bottom, #b3b3b3, #808080);
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b3b3b3', endColorstr='#808080', GradientType=0);
  border-color: #808080 #808080 #595959;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
  color: #fff;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
}

.datepicker table tr td.selected:hover,
.datepicker table tr td.selected:hover:hover,
.datepicker table tr td.selected.disabled:hover,
.datepicker table tr td.selected.disabled:hover:hover,
.datepicker table tr td.selected:active,
.datepicker table tr td.selected:hover:active,
.datepicker table tr td.selected.disabled:active,
.datepicker table tr td.selected.disabled:hover:active,
.datepicker table tr td.selected.active,
.datepicker table tr td.selected:hover.active,
.datepicker table tr td.selected.disabled.active,
.datepicker table tr td.selected.disabled:hover.active,
.datepicker table tr td.selected.disabled,
.datepicker table tr td.selected:hover.disabled,
.datepicker table tr td.selected.disabled.disabled,
.datepicker table tr td.selected.disabled:hover.disabled,
.datepicker table tr td.selected[disabled],
.datepicker table tr td.selected:hover[disabled],
.datepicker table tr td.selected.disabled[disabled],
.datepicker table tr td.selected.disabled:hover[disabled] {
  background-color: #808080;
}

.datepicker table tr td.selected:active,
.datepicker table tr td.selected:hover:active,
.datepicker table tr td.selected.disabled:active,
.datepicker table tr td.selected.disabled:hover:active,
.datepicker table tr td.selected.active,
.datepicker table tr td.selected:hover.active,
.datepicker table tr td.selected.disabled.active,
.datepicker table tr td.selected.disabled:hover.active {
  background-color: #666666 \9;
}

.datepicker table tr td.active div,
.datepicker table tr td.active:hover div,
.datepicker table tr td.active.disabled div,
.datepicker table tr td.active.disabled:hover div {
  background-color: #378C3F;
  color: #FFFFFF;
  -webkit-box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.2);
}

.datepicker table tr td.active:hover div,
.datepicker table tr td.active:hover:hover div,
.datepicker table tr td.active.disabled:hover div,
.datepicker table tr td.active.disabled:hover:hover div,
.datepicker table tr td.active:active div,
.datepicker table tr td.active:hover:active div,
.datepicker table tr td.active.disabled:active div,
.datepicker table tr td.active.disabled:hover:active div,
.datepicker table tr td.active.active div,
.datepicker table tr td.active:hover.active div,
.datepicker table tr td.active.disabled.active div,
.datepicker table tr td.active.disabled:hover.active div,
.datepicker table tr td.active.disabled div,
.datepicker table tr td.active:hover.disabled div,
.datepicker table tr td.active.disabled.disabled div,
.datepicker table tr td.active.disabled:hover.disabled div,
.datepicker table tr td.active[disabled] div,
.datepicker table tr td.active:hover[disabled] div,
.datepicker table tr td.active.disabled[disabled] div,
.datepicker table tr td.active.disabled:hover[disabled] div {
  background-color: #378C3F;
}

.datepicker table tr td.active:active,
.datepicker table tr td.active:hover:active,
.datepicker table tr td.active.disabled:active,
.datepicker table tr td.active.disabled:hover:active,
.datepicker table tr td.active.active,
.datepicker table tr td.active:hover.active,
.datepicker table tr td.active.disabled.active,
.datepicker table tr td.active.disabled:hover.active {
  background-color: #003399 \9;
}

.datepicker table tr td span {
  display: block;
  width: 41px;
  height: 41px;
  line-height: 41px;
  float: left;
  margin: 1%;
  font-size: 14px;
  cursor: pointer;
  border-radius: 50%;
}

.datepicker table tr td span:hover,
.datepicker table tr td span.focused {
  background: #eee;
}

.datepicker table tr td span.disabled,
.datepicker table tr td span.disabled:hover {
  background: none;
  color: #888;
  cursor: default;
}

.datepicker table tr td span.active,
.datepicker table tr td span.active:hover,
.datepicker table tr td span.active.disabled,
.datepicker table tr td span.active.disabled:hover {
  color: #fff;
  background-color: #378C3F;
}

.datepicker table tr td span.active:hover,
.datepicker table tr td span.active:hover:hover,
.datepicker table tr td span.active.disabled:hover,
.datepicker table tr td span.active.disabled:hover:hover,
.datepicker table tr td span.active:active,
.datepicker table tr td span.active:hover:active,
.datepicker table tr td span.active.disabled:active,
.datepicker table tr td span.active.disabled:hover:active,
.datepicker table tr td span.active.active,
.datepicker table tr td span.active:hover.active,
.datepicker table tr td span.active.disabled.active,
.datepicker table tr td span.active.disabled:hover.active,
.datepicker table tr td span.active.disabled,
.datepicker table tr td span.active:hover.disabled,
.datepicker table tr td span.active.disabled.disabled,
.datepicker table tr td span.active.disabled:hover.disabled,
.datepicker table tr td span.active[disabled],
.datepicker table tr td span.active:hover[disabled],
.datepicker table tr td span.active.disabled[disabled],
.datepicker table tr td span.active.disabled:hover[disabled] {
  background-color: #378C3F;
  -webkit-box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 1px 10px 0px rgba(0, 0, 0, 0.2);
}

.datepicker table tr td span.active:active,
.datepicker table tr td span.active:hover:active,
.datepicker table tr td span.active.disabled:active,
.datepicker table tr td span.active.disabled:hover:active,
.datepicker table tr td span.active.active,
.datepicker table tr td span.active:hover.active,
.datepicker table tr td span.active.disabled.active,
.datepicker table tr td span.active.disabled:hover.active {
  background-color: #003399 \9;
}

.datepicker table tr td span.old,
.datepicker table tr td span.new {
  color: #888;
}

.datepicker .datepicker-switch {
  width: auto;
  border-radius: 0.1875rem;
}

.datepicker .datepicker-switch,
.datepicker .prev,
.datepicker .next,
.datepicker tfoot tr th {
  cursor: pointer;
}

.datepicker .prev,
.datepicker .next {
  width: 35px;
  height: 35px;
}

.datepicker i {
  position: relative;
  top: 2px;
}

.datepicker .prev i {
  left: -1px;
}

.datepicker .next i {
  right: -1px;
}

.datepicker .datepicker-switch:hover,
.datepicker .prev:hover,
.datepicker .next:hover,
.datepicker tfoot tr th:hover {
  background: #eee;
}

.datepicker .prev.disabled,
.datepicker .next.disabled {
  visibility: hidden;
}

.datepicker .cw {
  font-size: 10px;
  width: 12px;
  padding: 0 2px 0 5px;
  vertical-align: middle;
}

.input-append.date .add-on,
.input-prepend.date .add-on {
  cursor: pointer;
}

.input-append.date .add-on i,
.input-prepend.date .add-on i {
  margin-top: 3px;
}

.input-daterange input {
  text-align: center;
}

.input-daterange input:first-child {
  border-radius: 3px 0 0 3px;
}

.input-daterange input:last-child {
  border-radius: 0 3px 3px 0;
}

.input-daterange .add-on {
  display: inline-block;
  width: auto;
  min-width: 16px;
  height: 18px;
  padding: 4px 5px;
  font-weight: normal;
  line-height: 18px;
  text-align: center;
  text-shadow: 0 1px 0 #fff;
  vertical-align: middle;
  background-color: #eee;
  border: 1px solid #ccc;
  margin-left: -5px;
  margin-right: -5px;
}

.btn,
.navbar .navbar-nav > a.btn {
  border-width: 2px;
  font-weight: 400;
  font-size: 0.8571em;
  line-height: 1.35em;
  margin: 5px 1px;
  border: none;
  border-radius: 0.1875rem;
  padding: 11px 22px;
  cursor: pointer;
  background-color: #888;
  color: #FFFFFF;
}

.btn:hover, .btn:focus, .btn:active, .btn.active, .btn:active:focus, .btn:active:hover, .btn.active:focus, .btn.active:hover,
.show > .btn.dropdown-toggle,
.show > .btn.dropdown-toggle:focus,
.show > .btn.dropdown-toggle:hover,
.navbar .navbar-nav > a.btn:hover,
.navbar .navbar-nav > a.btn:focus,
.navbar .navbar-nav > a.btn:active,
.navbar .navbar-nav > a.btn.active,
.navbar .navbar-nav > a.btn:active:focus,
.navbar .navbar-nav > a.btn:active:hover,
.navbar .navbar-nav > a.btn.active:focus,
.navbar .navbar-nav > a.btn.active:hover,
.show >
.navbar .navbar-nav > a.btn.dropdown-toggle,
.show >
.navbar .navbar-nav > a.btn.dropdown-toggle:focus,
.show >
.navbar .navbar-nav > a.btn.dropdown-toggle:hover {
  background-color: #979797;
  color: #FFFFFF;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn:hover,
.navbar .navbar-nav > a.btn:hover {
  -webkit-box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
          box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
}

.btn.disabled, .btn.disabled:hover, .btn.disabled:focus, .btn.disabled.focus, .btn.disabled:active, .btn.disabled.active, .btn:disabled, .btn:disabled:hover, .btn:disabled:focus, .btn:disabled.focus, .btn:disabled:active, .btn:disabled.active, .btn[disabled], .btn[disabled]:hover, .btn[disabled]:focus, .btn[disabled].focus, .btn[disabled]:active, .btn[disabled].active,
fieldset[disabled] .btn,
fieldset[disabled] .btn:hover,
fieldset[disabled] .btn:focus,
fieldset[disabled] .btn.focus,
fieldset[disabled] .btn:active,
fieldset[disabled] .btn.active,
.navbar .navbar-nav > a.btn.disabled,
.navbar .navbar-nav > a.btn.disabled:hover,
.navbar .navbar-nav > a.btn.disabled:focus,
.navbar .navbar-nav > a.btn.disabled.focus,
.navbar .navbar-nav > a.btn.disabled:active,
.navbar .navbar-nav > a.btn.disabled.active,
.navbar .navbar-nav > a.btn:disabled,
.navbar .navbar-nav > a.btn:disabled:hover,
.navbar .navbar-nav > a.btn:disabled:focus,
.navbar .navbar-nav > a.btn:disabled.focus,
.navbar .navbar-nav > a.btn:disabled:active,
.navbar .navbar-nav > a.btn:disabled.active,
.navbar .navbar-nav > a.btn[disabled],
.navbar .navbar-nav > a.btn[disabled]:hover,
.navbar .navbar-nav > a.btn[disabled]:focus,
.navbar .navbar-nav > a.btn[disabled].focus,
.navbar .navbar-nav > a.btn[disabled]:active,
.navbar .navbar-nav > a.btn[disabled].active,
fieldset[disabled]
.navbar .navbar-nav > a.btn,
fieldset[disabled]
.navbar .navbar-nav > a.btn:hover,
fieldset[disabled]
.navbar .navbar-nav > a.btn:focus,
fieldset[disabled]
.navbar .navbar-nav > a.btn.focus,
fieldset[disabled]
.navbar .navbar-nav > a.btn:active,
fieldset[disabled]
.navbar .navbar-nav > a.btn.active {
  background-color: #888;
  border-color: #888;
}

.btn.btn-simple,
.navbar .navbar-nav > a.btn.btn-simple {
  color: #888;
  border-color: #888;
}

.btn.btn-simple:hover, .btn.btn-simple:focus, .btn.btn-simple:active,
.navbar .navbar-nav > a.btn.btn-simple:hover,
.navbar .navbar-nav > a.btn.btn-simple:focus,
.navbar .navbar-nav > a.btn.btn-simple:active {
  background-color: transparent;
  color: #979797;
  border-color: #979797;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn.btn-link,
.navbar .navbar-nav > a.btn.btn-link {
  color: #888;
}

.btn.btn-link:hover, .btn.btn-link:focus, .btn.btn-link:active,
.navbar .navbar-nav > a.btn.btn-link:hover,
.navbar .navbar-nav > a.btn.btn-link:focus,
.navbar .navbar-nav > a.btn.btn-link:active {
  background-color: transparent;
  color: #979797;
  text-decoration: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn:hover, .btn:focus,
.navbar .navbar-nav > a.btn:hover,
.navbar .navbar-nav > a.btn:focus {
  opacity: 1;
  filter: alpha(opacity=100);
  outline: 0 !important;
}

.btn:active, .btn.active,
.open > .btn.dropdown-toggle,
.navbar .navbar-nav > a.btn:active,
.navbar .navbar-nav > a.btn.active,
.open >
.navbar .navbar-nav > a.btn.dropdown-toggle {
  -webkit-box-shadow: none;
  box-shadow: none;
  outline: 0 !important;
}

.btn.btn-icon,
.navbar .navbar-nav > a.btn.btn-icon {
  height: 2.375rem;
  min-width: 2.375rem;
  width: 2.375rem;
  padding: 0;
  font-size: 0.9375rem;
  overflow: hidden;
  position: relative;
  line-height: normal;
}

.btn.btn-icon.btn-simple,
.navbar .navbar-nav > a.btn.btn-icon.btn-simple {
  padding: 0;
}

.btn.btn-icon.btn-sm,
.navbar .navbar-nav > a.btn.btn-icon.btn-sm {
  height: 1.875rem;
  min-width: 1.875rem;
  width: 1.875rem;
}

.btn.btn-icon.btn-sm i.fa,
.btn.btn-icon.btn-sm i.now-ui-icons,
.navbar .navbar-nav > a.btn.btn-icon.btn-sm i.fa,
.navbar .navbar-nav > a.btn.btn-icon.btn-sm i.now-ui-icons {
  font-size: 0.6875rem;
}

.btn.btn-icon.btn-lg,
.navbar .navbar-nav > a.btn.btn-icon.btn-lg {
  height: 3.6rem;
  min-width: 3.6rem;
  width: 3.6rem;
}

.btn.btn-icon.btn-lg i.now-ui-icons,
.btn.btn-icon.btn-lg i.fa,
.navbar .navbar-nav > a.btn.btn-icon.btn-lg i.now-ui-icons,
.navbar .navbar-nav > a.btn.btn-icon.btn-lg i.fa {
  font-size: 1.325rem;
}

.btn.btn-icon:not(.btn-footer) i.now-ui-icons,
.btn.btn-icon:not(.btn-footer) i.fa,
.navbar .navbar-nav > a.btn.btn-icon:not(.btn-footer) i.now-ui-icons,
.navbar .navbar-nav > a.btn.btn-icon:not(.btn-footer) i.fa {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-12px, -12px);
          transform: translate(-12px, -12px);
  line-height: 1.5626rem;
  width: 25px;
}

.btn:not(.btn-icon) .now-ui-icons,
.navbar .navbar-nav > a.btn:not(.btn-icon) .now-ui-icons {
  position: relative;
  top: 1px;
}

.btn-primary {
  background-color: #378C3F;
  color: #FFFFFF;
}

.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .btn-primary:active:focus, .btn-primary:active:hover, .btn-primary.active:focus, .btn-primary.active:hover,
.show > .btn-primary.dropdown-toggle,
.show > .btn-primary.dropdown-toggle:focus,
.show > .btn-primary.dropdown-toggle:hover {
  background-color: #40a249;
  color: #FFFFFF;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-primary:hover {
  -webkit-box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
          box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
}

.btn-primary.disabled, .btn-primary.disabled:hover, .btn-primary.disabled:focus, .btn-primary.disabled.focus, .btn-primary.disabled:active, .btn-primary.disabled.active, .btn-primary:disabled, .btn-primary:disabled:hover, .btn-primary:disabled:focus, .btn-primary:disabled.focus, .btn-primary:disabled:active, .btn-primary:disabled.active, .btn-primary[disabled], .btn-primary[disabled]:hover, .btn-primary[disabled]:focus, .btn-primary[disabled].focus, .btn-primary[disabled]:active, .btn-primary[disabled].active,
fieldset[disabled] .btn-primary,
fieldset[disabled] .btn-primary:hover,
fieldset[disabled] .btn-primary:focus,
fieldset[disabled] .btn-primary.focus,
fieldset[disabled] .btn-primary:active,
fieldset[disabled] .btn-primary.active {
  background-color: #378C3F;
  border-color: #378C3F;
}

.btn-primary.btn-simple {
  color: #378C3F;
  border-color: #378C3F;
}

.btn-primary.btn-simple:hover, .btn-primary.btn-simple:focus, .btn-primary.btn-simple:active {
  background-color: transparent;
  color: #40a249;
  border-color: #40a249;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-primary.btn-link {
  color: #378C3F;
}

.btn-primary.btn-link:hover, .btn-primary.btn-link:focus, .btn-primary.btn-link:active {
  background-color: transparent;
  color: #40a249;
  text-decoration: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-success {
  background-color: #18ce0f;
  color: #FFFFFF;
}

.btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .btn-success:active:focus, .btn-success:active:hover, .btn-success.active:focus, .btn-success.active:hover,
.show > .btn-success.dropdown-toggle,
.show > .btn-success.dropdown-toggle:focus,
.show > .btn-success.dropdown-toggle:hover {
  background-color: #1beb11;
  color: #FFFFFF;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-success:hover {
  -webkit-box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
          box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
}

.btn-success.disabled, .btn-success.disabled:hover, .btn-success.disabled:focus, .btn-success.disabled.focus, .btn-success.disabled:active, .btn-success.disabled.active, .btn-success:disabled, .btn-success:disabled:hover, .btn-success:disabled:focus, .btn-success:disabled.focus, .btn-success:disabled:active, .btn-success:disabled.active, .btn-success[disabled], .btn-success[disabled]:hover, .btn-success[disabled]:focus, .btn-success[disabled].focus, .btn-success[disabled]:active, .btn-success[disabled].active,
fieldset[disabled] .btn-success,
fieldset[disabled] .btn-success:hover,
fieldset[disabled] .btn-success:focus,
fieldset[disabled] .btn-success.focus,
fieldset[disabled] .btn-success:active,
fieldset[disabled] .btn-success.active {
  background-color: #18ce0f;
  border-color: #18ce0f;
}

.btn-success.btn-simple {
  color: #18ce0f;
  border-color: #18ce0f;
}

.btn-success.btn-simple:hover, .btn-success.btn-simple:focus, .btn-success.btn-simple:active {
  background-color: transparent;
  color: #1beb11;
  border-color: #1beb11;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-success.btn-link {
  color: #18ce0f;
}

.btn-success.btn-link:hover, .btn-success.btn-link:focus, .btn-success.btn-link:active {
  background-color: transparent;
  color: #1beb11;
  text-decoration: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-info {
  background-color: #2CA8FF;
  color: #FFFFFF;
}

.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .btn-info:active:focus, .btn-info:active:hover, .btn-info.active:focus, .btn-info.active:hover,
.show > .btn-info.dropdown-toggle,
.show > .btn-info.dropdown-toggle:focus,
.show > .btn-info.dropdown-toggle:hover {
  background-color: #4bb5ff;
  color: #FFFFFF;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-info:hover {
  -webkit-box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
          box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
}

.btn-info.disabled, .btn-info.disabled:hover, .btn-info.disabled:focus, .btn-info.disabled.focus, .btn-info.disabled:active, .btn-info.disabled.active, .btn-info:disabled, .btn-info:disabled:hover, .btn-info:disabled:focus, .btn-info:disabled.focus, .btn-info:disabled:active, .btn-info:disabled.active, .btn-info[disabled], .btn-info[disabled]:hover, .btn-info[disabled]:focus, .btn-info[disabled].focus, .btn-info[disabled]:active, .btn-info[disabled].active,
fieldset[disabled] .btn-info,
fieldset[disabled] .btn-info:hover,
fieldset[disabled] .btn-info:focus,
fieldset[disabled] .btn-info.focus,
fieldset[disabled] .btn-info:active,
fieldset[disabled] .btn-info.active {
  background-color: #2CA8FF;
  border-color: #2CA8FF;
}

.btn-info.btn-simple {
  color: #2CA8FF;
  border-color: #2CA8FF;
}

.btn-info.btn-simple:hover, .btn-info.btn-simple:focus, .btn-info.btn-simple:active {
  background-color: transparent;
  color: #4bb5ff;
  border-color: #4bb5ff;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-info.btn-link {
  color: #2CA8FF;
}

.btn-info.btn-link:hover, .btn-info.btn-link:focus, .btn-info.btn-link:active {
  background-color: transparent;
  color: #4bb5ff;
  text-decoration: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-warning {
  background-color: #FFB236;
  color: #FFFFFF;
}

.btn-warning:hover, .btn-warning:focus, .btn-warning:active, .btn-warning.active, .btn-warning:active:focus, .btn-warning:active:hover, .btn-warning.active:focus, .btn-warning.active:hover,
.show > .btn-warning.dropdown-toggle,
.show > .btn-warning.dropdown-toggle:focus,
.show > .btn-warning.dropdown-toggle:hover {
  background-color: #ffbe55;
  color: #FFFFFF;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-warning:hover {
  -webkit-box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
          box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
}

.btn-warning.disabled, .btn-warning.disabled:hover, .btn-warning.disabled:focus, .btn-warning.disabled.focus, .btn-warning.disabled:active, .btn-warning.disabled.active, .btn-warning:disabled, .btn-warning:disabled:hover, .btn-warning:disabled:focus, .btn-warning:disabled.focus, .btn-warning:disabled:active, .btn-warning:disabled.active, .btn-warning[disabled], .btn-warning[disabled]:hover, .btn-warning[disabled]:focus, .btn-warning[disabled].focus, .btn-warning[disabled]:active, .btn-warning[disabled].active,
fieldset[disabled] .btn-warning,
fieldset[disabled] .btn-warning:hover,
fieldset[disabled] .btn-warning:focus,
fieldset[disabled] .btn-warning.focus,
fieldset[disabled] .btn-warning:active,
fieldset[disabled] .btn-warning.active {
  background-color: #FFB236;
  border-color: #FFB236;
}

.btn-warning.btn-simple {
  color: #FFB236;
  border-color: #FFB236;
}

.btn-warning.btn-simple:hover, .btn-warning.btn-simple:focus, .btn-warning.btn-simple:active {
  background-color: transparent;
  color: #ffbe55;
  border-color: #ffbe55;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-warning.btn-link {
  color: #FFB236;
}

.btn-warning.btn-link:hover, .btn-warning.btn-link:focus, .btn-warning.btn-link:active {
  background-color: transparent;
  color: #ffbe55;
  text-decoration: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-danger {
  background-color: #FF3636;
  color: #FFFFFF;
}

.btn-danger:hover, .btn-danger:focus, .btn-danger:active, .btn-danger.active, .btn-danger:active:focus, .btn-danger:active:hover, .btn-danger.active:focus, .btn-danger.active:hover,
.show > .btn-danger.dropdown-toggle,
.show > .btn-danger.dropdown-toggle:focus,
.show > .btn-danger.dropdown-toggle:hover {
  background-color: #ff5555;
  color: #FFFFFF;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-danger:hover {
  -webkit-box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
          box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
}

.btn-danger.disabled, .btn-danger.disabled:hover, .btn-danger.disabled:focus, .btn-danger.disabled.focus, .btn-danger.disabled:active, .btn-danger.disabled.active, .btn-danger:disabled, .btn-danger:disabled:hover, .btn-danger:disabled:focus, .btn-danger:disabled.focus, .btn-danger:disabled:active, .btn-danger:disabled.active, .btn-danger[disabled], .btn-danger[disabled]:hover, .btn-danger[disabled]:focus, .btn-danger[disabled].focus, .btn-danger[disabled]:active, .btn-danger[disabled].active,
fieldset[disabled] .btn-danger,
fieldset[disabled] .btn-danger:hover,
fieldset[disabled] .btn-danger:focus,
fieldset[disabled] .btn-danger.focus,
fieldset[disabled] .btn-danger:active,
fieldset[disabled] .btn-danger.active {
  background-color: #FF3636;
  border-color: #FF3636;
}

.btn-danger.btn-simple {
  color: #FF3636;
  border-color: #FF3636;
}

.btn-danger.btn-simple:hover, .btn-danger.btn-simple:focus, .btn-danger.btn-simple:active {
  background-color: transparent;
  color: #ff5555;
  border-color: #ff5555;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-danger.btn-link {
  color: #FF3636;
}

.btn-danger.btn-link:hover, .btn-danger.btn-link:focus, .btn-danger.btn-link:active {
  background-color: transparent;
  color: #ff5555;
  text-decoration: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-neutral {
  background-color: #FFFFFF;
  color: #378C3F;
}

.btn-neutral:hover, .btn-neutral:focus, .btn-neutral:active, .btn-neutral.active, .btn-neutral:active:focus, .btn-neutral:active:hover, .btn-neutral.active:focus, .btn-neutral.active:hover,
.show > .btn-neutral.dropdown-toggle,
.show > .btn-neutral.dropdown-toggle:focus,
.show > .btn-neutral.dropdown-toggle:hover {
  background-color: #FFFFFF;
  color: #FFFFFF;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-neutral:hover {
  -webkit-box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
          box-shadow: 0 3px 8px 0 rgba(0, 0, 0, 0.17);
}

.btn-neutral.disabled, .btn-neutral.disabled:hover, .btn-neutral.disabled:focus, .btn-neutral.disabled.focus, .btn-neutral.disabled:active, .btn-neutral.disabled.active, .btn-neutral:disabled, .btn-neutral:disabled:hover, .btn-neutral:disabled:focus, .btn-neutral:disabled.focus, .btn-neutral:disabled:active, .btn-neutral:disabled.active, .btn-neutral[disabled], .btn-neutral[disabled]:hover, .btn-neutral[disabled]:focus, .btn-neutral[disabled].focus, .btn-neutral[disabled]:active, .btn-neutral[disabled].active,
fieldset[disabled] .btn-neutral,
fieldset[disabled] .btn-neutral:hover,
fieldset[disabled] .btn-neutral:focus,
fieldset[disabled] .btn-neutral.focus,
fieldset[disabled] .btn-neutral:active,
fieldset[disabled] .btn-neutral.active {
  background-color: #FFFFFF;
  border-color: #FFFFFF;
}

.btn-neutral.btn-danger {
  color: #FF3636;
}

.btn-neutral.btn-danger:hover, .btn-neutral.btn-danger:focus, .btn-neutral.btn-danger:active {
  color: #ff5555;
}

.btn-neutral.btn-info {
  color: #2CA8FF;
}

.btn-neutral.btn-info:hover, .btn-neutral.btn-info:focus, .btn-neutral.btn-info:active {
  color: #4bb5ff;
}

.btn-neutral.btn-warning {
  color: #FFB236;
}

.btn-neutral.btn-warning:hover, .btn-neutral.btn-warning:focus, .btn-neutral.btn-warning:active {
  color: #ffbe55;
}

.btn-neutral.btn-success {
  color: #18ce0f;
}

.btn-neutral.btn-success:hover, .btn-neutral.btn-success:focus, .btn-neutral.btn-success:active {
  color: #1beb11;
}

.btn-neutral.btn-default {
  color: #888;
}

.btn-neutral.btn-default:hover, .btn-neutral.btn-default:focus, .btn-neutral.btn-default:active {
  color: #979797;
}

.btn-neutral.active, .btn-neutral:active, .btn-neutral:active:focus, .btn-neutral:active:hover, .btn-neutral.active:focus, .btn-neutral.active:hover,
.show > .btn-neutral.dropdown-toggle,
.show > .btn-neutral.dropdown-toggle:focus,
.show > .btn-neutral.dropdown-toggle:hover {
  background-color: #FFFFFF;
  color: #40a249;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-neutral:hover, .btn-neutral:focus {
  color: #40a249;
}

.btn-neutral:hover:not(.nav-link), .btn-neutral:focus:not(.nav-link) {
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-neutral.btn-simple {
  color: #FFFFFF;
  border-color: #FFFFFF;
}

.btn-neutral.btn-simple:hover, .btn-neutral.btn-simple:focus, .btn-neutral.btn-simple:active {
  background-color: transparent;
  color: #FFFFFF;
  border-color: #FFFFFF;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn-neutral.btn-link {
  color: #FFFFFF;
}

.btn-neutral.btn-link:hover, .btn-neutral.btn-link:focus, .btn-neutral.btn-link:active {
  background-color: transparent;
  color: #FFFFFF;
  text-decoration: none;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.btn:disabled, .btn[disabled], .btn.disabled {
  opacity: 0.5;
  filter: alpha(opacity=50);
}

.btn-round {
  border-width: 1px;
  border-radius: 30px !important;
  padding: 11px 23px;
}

.btn-round.btn-simple {
  padding: 10px 22px;
}

.btn-simple {
  border: 1px solid;
  border-color: #888;
  padding: 10px 22px;
  background-color: transparent;
}

.btn-simple.disabled, .btn-simple.disabled:hover, .btn-simple.disabled:focus, .btn-simple.disabled.focus, .btn-simple.disabled:active, .btn-simple.disabled.active, .btn-simple:disabled, .btn-simple:disabled:hover, .btn-simple:disabled:focus, .btn-simple:disabled.focus, .btn-simple:disabled:active, .btn-simple:disabled.active, .btn-simple[disabled], .btn-simple[disabled]:hover, .btn-simple[disabled]:focus, .btn-simple[disabled].focus, .btn-simple[disabled]:active, .btn-simple[disabled].active,
fieldset[disabled] .btn-simple,
fieldset[disabled] .btn-simple:hover,
fieldset[disabled] .btn-simple:focus,
fieldset[disabled] .btn-simple.focus,
fieldset[disabled] .btn-simple:active,
fieldset[disabled] .btn-simple.active,
.btn-link.disabled,
.btn-link.disabled:hover,
.btn-link.disabled:focus,
.btn-link.disabled.focus,
.btn-link.disabled:active,
.btn-link.disabled.active,
.btn-link:disabled,
.btn-link:disabled:hover,
.btn-link:disabled:focus,
.btn-link:disabled.focus,
.btn-link:disabled:active,
.btn-link:disabled.active,
.btn-link[disabled],
.btn-link[disabled]:hover,
.btn-link[disabled]:focus,
.btn-link[disabled].focus,
.btn-link[disabled]:active,
.btn-link[disabled].active,
fieldset[disabled]
.btn-link,
fieldset[disabled]
.btn-link:hover,
fieldset[disabled]
.btn-link:focus,
fieldset[disabled]
.btn-link.focus,
fieldset[disabled]
.btn-link:active,
fieldset[disabled]
.btn-link.active {
  background-color: transparent;
}

.btn-lg {
  font-size: 1em;
  border-radius: 0.25rem;
  padding: 15px 48px;
}

.btn-lg.btn-simple {
  padding: 14px 47px;
}

.btn-sm {
  font-size: 14px;
  border-radius: 0.1875rem;
  padding: 5px 15px;
}

.btn-sm.btn-simple {
  padding: 4px 14px;
}

.btn-link {
  border: 0;
  padding: 0.5rem 0.7rem;
  background-color: transparent;
}

.btn-wd {
  min-width: 140px;
}

.btn-group.select {
  width: 100%;
}

.btn-group.select .btn {
  text-align: left;
}

.btn-group.select .caret {
  position: absolute;
  top: 50%;
  margin-top: -1px;
  right: 8px;
}

.form-control::-moz-placeholder {
  color: #DDDDDD;
  opacity: 1;
  filter: alpha(opacity=100);
}

.form-control:-moz-placeholder {
  color: #DDDDDD;
  opacity: 1;
  filter: alpha(opacity=100);
}

.form-control::-webkit-input-placeholder {
  color: #DDDDDD;
  opacity: 1;
  filter: alpha(opacity=100);
}

.form-control:-ms-input-placeholder {
  color: #DDDDDD;
  opacity: 1;
  filter: alpha(opacity=100);
}

.form-control {
  background-color: transparent;
  border: 1px solid #E3E3E3;
  border-radius: 30px;
  color: #2c2c2c;
  line-height: normal;
  font-size: 0.8571em;
  -webkit-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
  transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.has-success .form-control {
  border-color: #E3E3E3;
}

.form-control:focus {
  border: 1px solid #378C3F;
  -webkit-box-shadow: none;
  box-shadow: none;
  outline: 0 !important;
  color: #2c2c2c;
}

.form-control:focus + .input-group-addon,
.form-control:focus ~ .input-group-addon {
  border: 1px solid #378C3F;
  border-left: none;
  background-color: transparent;
}

.has-success .form-control,
.has-error .form-control,
.has-success .form-control:focus,
.has-error .form-control:focus {
  -webkit-box-shadow: none;
  box-shadow: none;
}

.has-success .form-control:focus {
  border-color: #1be611;
}

.has-danger .form-control.form-control-success, .has-danger .form-control.form-control-danger,
.has-success .form-control.form-control-success,
.has-success .form-control.form-control-danger {
  background-image: none;
}

.has-danger .form-control {
  border-color: #ffcfcf;
  color: #FF3636;
  background-color: rgba(222, 222, 222, 0.1);
}

.has-danger .form-control:focus {
  background-color: #FFFFFF;
}

.form-control + .form-control-feedback {
  border-radius: 0.25rem;
  font-size: 14px;
  margin-top: 0;
  position: absolute;
  left: 18px;
  bottom: -20px;
  vertical-align: middle;
}

.open .form-control {
  border-radius: 0.25rem 0.25rem 0 0;
  border-bottom-color: transparent;
}

.form-control + .input-group-addon {
  background-color: #FFFFFF;
}

.has-success:after,
.has-danger:after {
  font-family: 'Nucleo Outline';
  content: "\ea22";
  display: inline-block;
  position: absolute;
  right: 15px;
  bottom: 10px;
  color: #18ce0f;
  font-size: 11px;
}

.has-success.input-lg:after,
.has-danger.input-lg:after {
  font-size: 13px;
  top: 13px;
}

.has-danger:after {
  content: "\ea53";
  color: #FF3636;
}

.form-group.form-group-no-border.input-lg .input-group-addon,
.input-group.form-group-no-border.input-lg .input-group-addon {
  padding: 15px 0 15px 19px;
}

.form-group.form-group-no-border.input-lg .form-control,
.input-group.form-group-no-border.input-lg .form-control {
  padding: 15px 19px;
}

.form-group.form-group-no-border.input-lg .form-control + .input-group-addon,
.input-group.form-group-no-border.input-lg .form-control + .input-group-addon {
  padding: 15px 19px 15px 0;
}

.form-group.input-lg .form-control,
.input-group.input-lg .form-control {
  padding: 14px 18px;
}

.form-group.input-lg .form-control + .input-group-addon,
.input-group.input-lg .form-control + .input-group-addon {
  padding: 14px 18px 14px 0;
}

.form-group.input-lg .input-group-addon,
.input-group.input-lg .input-group-addon {
  padding: 14px 0 15px 18px;
}

.form-group.input-lg .input-group-addon + .form-control,
.input-group.input-lg .input-group-addon + .form-control {
  padding: 15px 18px 15px 16px;
}

.form-group.form-group-no-border .form-control,
.input-group.form-group-no-border .form-control {
  padding: 11px 19px;
}

.form-group.form-group-no-border .form-control + .input-group-addon,
.input-group.form-group-no-border .form-control + .input-group-addon {
  padding: 11px 19px 11px 0;
}

.form-group.form-group-no-border .input-group-addon,
.input-group.form-group-no-border .input-group-addon {
  padding: 11px 0 11px 19px;
}

.form-group .form-control,
.input-group .form-control {
  padding: 10px 18px 10px 18px;
}

.form-group .form-control + .input-group-addon,
.input-group .form-control + .input-group-addon {
  padding: 10px 18px 10px 0;
}

.form-group .input-group-addon,
.input-group .input-group-addon {
  padding: 10px 0 10px 18px;
}

.form-group .input-group-addon + .form-control,
.form-group .input-group-addon ~ .form-control,
.input-group .input-group-addon + .form-control,
.input-group .input-group-addon ~ .form-control {
  padding: 10px 19px 11px 16px;
}

.form-group.form-group-no-border .form-control,
.form-group.form-group-no-border .form-control + .input-group-addon,
.input-group.form-group-no-border .form-control,
.input-group.form-group-no-border .form-control + .input-group-addon {
  background-color: rgba(222, 222, 222, 0.3);
  border: medium none;
}

.form-group.form-group-no-border .form-control:focus, .form-group.form-group-no-border .form-control:active, .form-group.form-group-no-border .form-control:active,
.form-group.form-group-no-border .form-control + .input-group-addon:focus,
.form-group.form-group-no-border .form-control + .input-group-addon:active,
.form-group.form-group-no-border .form-control + .input-group-addon:active,
.input-group.form-group-no-border .form-control:focus,
.input-group.form-group-no-border .form-control:active,
.input-group.form-group-no-border .form-control:active,
.input-group.form-group-no-border .form-control + .input-group-addon:focus,
.input-group.form-group-no-border .form-control + .input-group-addon:active,
.input-group.form-group-no-border .form-control + .input-group-addon:active {
  border: medium none;
  background-color: rgba(222, 222, 222, 0.5);
}

.form-group.form-group-no-border .form-control:focus + .input-group-addon,
.input-group.form-group-no-border .form-control:focus + .input-group-addon {
  background-color: rgba(222, 222, 222, 0.5);
}

.form-group.form-group-no-border .input-group-addon,
.input-group.form-group-no-border .input-group-addon {
  background-color: rgba(222, 222, 222, 0.3);
  border: none;
}

.has-error .form-control-feedback, .has-error .control-label {
  color: #FF3636;
}

.has-success .form-control-feedback, .has-success .control-label {
  color: #18ce0f;
}

.input-group-addon {
  background-color: #FFFFFF;
  border: 1px solid #E3E3E3;
  border-radius: 30px;
  color: #555555;
  padding: -0.5rem 0 -0.5rem -0.3rem;
  -webkit-transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
  transition: color 0.3s ease-in-out, border-color 0.3s ease-in-out, background-color 0.3s ease-in-out;
}

.has-success .input-group-addon,
.has-danger .input-group-addon {
  background-color: #FFFFFF;
}

.has-danger .form-control:focus + .input-group-addon {
  color: #FF3636;
}

.has-success .form-control:focus + .input-group-addon {
  color: #18ce0f;
}

.input-group-addon + .form-control,
.input-group-addon ~ .form-control {
  padding: -0.5rem 0.7rem;
  padding-left: 18px;
}

.input-group-addon i {
  width: 17px;
}

.input-group-focus .input-group-addon {
  background-color: #FFFFFF;
  border-color: #378C3F;
}

.input-group-focus.form-group-no-border .input-group-addon {
  background-color: rgba(222, 222, 222, 0.5);
}

.input-group,
.form-group {
  margin-bottom: 10px;
}

.input-group[disabled] .input-group-addon {
  background-color: #E3E3E3;
}

.input-group .form-control:first-child,
.input-group-addon:first-child,
.input-group-btn:first-child > .dropdown-toggle,
.input-group-btn:last-child > .btn:not(:last-child):not(.dropdown-toggle) {
  border-right: 0 none;
}

.input-group .form-control:last-child,
.input-group-addon:last-child,
.input-group-btn:last-child > .dropdown-toggle,
.input-group-btn:first-child > .btn:not(:first-child) {
  border-left: 0 none;
}

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
  background-color: #E3E3E3;
  color: #888;
  cursor: not-allowed;
}

.input-group-btn .btn {
  border-width: 1px;
  padding: 11px 0.7rem;
}

.input-group-btn .btn-default:not(.btn-fill) {
  border-color: #DDDDDD;
}

.input-group-btn:last-child > .btn {
  margin-left: 0;
}

textarea.form-control {
  max-width: 100%;
  padding: 10px 10px 0 0;
  resize: none;
  border: none;
  border-bottom: 1px solid #E3E3E3;
  border-radius: 0;
  line-height: 2;
}

textarea.form-control:focus, textarea.form-control:active {
  border-left: none;
  border-top: none;
  border-right: none;
}

.has-success.form-group .form-control,
.has-success.form-group.form-group-no-border .form-control,
.has-danger.form-group .form-control,
.has-danger.form-group.form-group-no-border .form-control {
  padding-right: 40px;
}

.form-group {
  position: relative;
}

.form-group.has-error, .form-group.has-danger {
  margin-bottom: 20px;
}

.checkbox,
.radio {
  margin-bottom: 12px;
}

.checkbox label,
.radio label {
  display: inline-block;
  position: relative;
  cursor: pointer;
  padding-left: 35px;
  line-height: 26px;
  margin-bottom: 0;
}

.radio label {
  padding-left: 28px;
}

.checkbox label::before,
.checkbox label::after {
  content: " ";
  display: inline-block;
  position: absolute;
  width: 26px;
  height: 26px;
  left: 0;
  cursor: pointer;
  border-radius: 3px;
  top: 0;
  background-color: transparent;
  border: 1px solid #E3E3E3;
  -webkit-transition: opacity 0.3s linear;
  transition: opacity 0.3s linear;
}

.checkbox label::after {
  font-family: 'Nucleo Outline';
  content: "\ea22";
  top: 0px;
  text-align: center;
  font-size: 14px;
  opacity: 0;
  color: #555555;
  border: 0;
  background-color: inherit;
}

.checkbox input[type="checkbox"],
.radio input[type="radio"] {
  opacity: 0;
  position: absolute;
  visibility: hidden;
}

.checkbox input[type="checkbox"]:checked + label::after {
  opacity: 1;
}

.checkbox input[type="checkbox"]:disabled + label,
.radio input[type="radio"]:disabled + label {
  color: #9A9A9A;
  opacity: .5;
}

.checkbox input[type="checkbox"]:disabled + label::before,
.checkbox input[type="checkbox"]:disabled + label::after {
  cursor: not-allowed;
}

.checkbox input[type="checkbox"]:disabled + label,
.radio input[type="radio"]:disabled + label {
  cursor: not-allowed;
}

.checkbox.checkbox-circle label::before {
  border-radius: 50%;
}

.checkbox.checkbox-inline {
  margin-top: 0;
}

.checkbox-primary input[type="checkbox"]:checked + label::before {
  background-color: #428bca;
  border-color: #428bca;
}

.checkbox-primary input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.checkbox-danger input[type="checkbox"]:checked + label::before {
  background-color: #d9534f;
  border-color: #d9534f;
}

.checkbox-danger input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.checkbox-info input[type="checkbox"]:checked + label::before {
  background-color: #5bc0de;
  border-color: #5bc0de;
}

.checkbox-info input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.checkbox-warning input[type="checkbox"]:checked + label::before {
  background-color: #f0ad4e;
  border-color: #f0ad4e;
}

.checkbox-warning input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.checkbox-success input[type="checkbox"]:checked + label::before {
  background-color: #5cb85c;
  border-color: #5cb85c;
}

.checkbox-success input[type="checkbox"]:checked + label::after {
  color: #fff;
}

.radio label::before,
.radio label::after {
  content: " ";
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 1px solid #E3E3E3;
  display: inline-block;
  position: absolute;
  left: 3px;
  top: 3px;
  padding: 1px;
  -webkit-transition: opacity 0.3s linear;
  transition: opacity 0.3s linear;
}

.radio input[type="radio"] + label:after,
.radio input[type="radio"] {
  opacity: 0;
}

.radio input[type="radio"]:checked + label::after {
  width: 4px;
  height: 4px;
  background-color: #555555;
  border-color: #555555;
  top: 11px;
  left: 11px;
  opacity: 1;
}

.radio input[type="radio"]:checked + label::after {
  opacity: 1;
}

.radio input[type="radio"]:disabled + label {
  color: #9A9A9A;
}

.radio input[type="radio"]:disabled + label::before,
.radio input[type="radio"]:disabled + label::after {
  color: #9A9A9A;
}

.radio.radio-inline {
  margin-top: 0;
}

.progress-container {
  position: relative;
}

.progress-container + .progress-container,
.progress-container ~ .progress-container {
  margin-top: 15px;
}

.progress-container .progress-badge {
  color: #888;
  font-size: 0.8571em;
  text-transform: uppercase;
}

.progress-container .progress {
  height: 1px;
  border-radius: 0;
  -webkit-box-shadow: none;
          box-shadow: none;
  background: rgba(222, 222, 222, 0.8);
  margin-top: 14px;
}

.progress-container .progress .progress-bar {
  -webkit-box-shadow: none;
          box-shadow: none;
  background-color: #888;
}

.progress-container .progress .progress-value {
  position: absolute;
  top: 2px;
  right: 0;
  color: #888;
  font-size: 0.8571em;
}

.progress-container.progress-neutral .progress {
  background: rgba(255, 255, 255, 0.3);
}

.progress-container.progress-neutral .progress-bar {
  background: #FFFFFF;
}

.progress-container.progress-neutral .progress-value,
.progress-container.progress-neutral .progress-badge {
  color: #FFFFFF;
}

.progress-container.progress-primary .progress {
  background: rgba(55, 140, 63, 0.4);
}

.progress-container.progress-primary .progress-bar {
  background: #378C3F;
}

.progress-container.progress-primary .progress-value,
.progress-container.progress-primary .progress-badge {
  color: #378C3F;
}

.progress-container.progress-info .progress {
  background: rgba(44, 168, 255, 0.3);
}

.progress-container.progress-info .progress-bar {
  background: #2CA8FF;
}

.progress-container.progress-info .progress-value,
.progress-container.progress-info .progress-badge {
  color: #2CA8FF;
}

.progress-container.progress-success .progress {
  background: rgba(24, 206, 15, 0.3);
}

.progress-container.progress-success .progress-bar {
  background: #18ce0f;
}

.progress-container.progress-success .progress-value,
.progress-container.progress-success .progress-badge {
  color: #18ce0f;
}

.progress-container.progress-warning .progress {
  background: rgba(255, 178, 54, 0.3);
}

.progress-container.progress-warning .progress-bar {
  background: #FFB236;
}

.progress-container.progress-warning .progress-value,
.progress-container.progress-warning .progress-badge {
  color: #FFB236;
}

.progress-container.progress-danger .progress {
  background: rgba(255, 54, 54, 0.3);
}

.progress-container.progress-danger .progress-bar {
  background: #FF3636;
}

.progress-container.progress-danger .progress-value,
.progress-container.progress-danger .progress-badge {
  color: #FF3636;
}

/*           badges             */
.badge {
  border-radius: 8px;
  padding: 4px 8px;
  text-transform: uppercase;
  font-size: 0.7142em;
  line-height: 12px;
  background-color: transparent;
  border: 1px solid;
  margin-bottom: 5px;
  border-radius: 0.875rem;
}

.badge-icon {
  padding: 0.4em 0.55em;
}

.badge-icon i {
  font-size: 0.8em;
}

.badge-default {
  border-color: #888;
  color: #888;
}

.badge-primary {
  border-color: #378C3F;
  color: #378C3F;
}

.badge-info {
  border-color: #2CA8FF;
  color: #2CA8FF;
}

.badge-success {
  border-color: #18ce0f;
  color: #18ce0f;
}

.badge-warning {
  border-color: #FFB236;
  color: #FFB236;
}

.badge-danger {
  border-color: #FF3636;
  color: #FF3636;
}

.badge-neutral {
  border-color: #FFFFFF;
  color: #FFFFFF;
}

.pagination .page-item .page-link {
  border: 0;
  border-radius: 30px !important;
  -webkit-transition: all .3s;
  transition: all .3s;
  padding: 0px 11px;
  margin: 0 3px;
  min-width: 30px;
  text-align: center;
  height: 30px;
  line-height: 30px;
  color: #2c2c2c;
  cursor: pointer;
  font-size: 14px;
  text-transform: uppercase;
  background: transparent;
}

.pagination .page-item .page-link:hover, .pagination .page-item .page-link:focus {
  color: #2c2c2c;
  background-color: rgba(222, 222, 222, 0.3);
  border: none;
}

.pagination .arrow-margin-left,
.pagination .arrow-margin-right {
  position: absolute;
}

.pagination .arrow-margin-right {
  right: 0;
}

.pagination .arrow-margin-left {
  left: 0;
}

.pagination .page-item.active > .page-link {
  color: #E3E3E3;
  -webkit-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
}

.pagination .page-item.active > .page-link, .pagination .page-item.active > .page-link:focus, .pagination .page-item.active > .page-link:hover {
  background-color: #888;
  border-color: #888;
  color: #FFFFFF;
}

.pagination .page-item.disabled > .page-link {
  opacity: .5;
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

.pagination.pagination-info .page-item.active > .page-link, .pagination.pagination-info .page-item.active > .page-link:focus, .pagination.pagination-info .page-item.active > .page-link:hover {
  background-color: #2CA8FF;
  border-color: #2CA8FF;
}

.pagination.pagination-success .page-item.active > .page-link, .pagination.pagination-success .page-item.active > .page-link:focus, .pagination.pagination-success .page-item.active > .page-link:hover {
  background-color: #18ce0f;
  border-color: #18ce0f;
}

.pagination.pagination-primary .page-item.active > .page-link, .pagination.pagination-primary .page-item.active > .page-link:focus, .pagination.pagination-primary .page-item.active > .page-link:hover {
  background-color: #378C3F;
  border-color: #378C3F;
}

.pagination.pagination-warning .page-item.active > .page-link, .pagination.pagination-warning .page-item.active > .page-link:focus, .pagination.pagination-warning .page-item.active > .page-link:hover {
  background-color: #FFB236;
  border-color: #FFB236;
}

.pagination.pagination-danger .page-item.active > .page-link, .pagination.pagination-danger .page-item.active > .page-link:focus, .pagination.pagination-danger .page-item.active > .page-link:hover {
  background-color: #FF3636;
  border-color: #FF3636;
}

.pagination.pagination-neutral .page-item > .page-link {
  color: #FFFFFF;
}

.pagination.pagination-neutral .page-item > .page-link:focus, .pagination.pagination-neutral .page-item > .page-link:hover {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

.pagination.pagination-neutral .page-item.active > .page-link, .pagination.pagination-neutral .page-item.active > .page-link:focus, .pagination.pagination-neutral .page-item.active > .page-link:hover {
  background-color: #FFFFFF;
  border-color: #FFFFFF;
  color: #378C3F;
}

button,
input,
optgroup,
select,
textarea {
  font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
}

h1, h2, h3, h4, h5, h6 {
  font-weight: 400;
}

small {
  font-size: 60%;
}

a {
  color: #378C3F;
}

a:hover, a:focus {
  color: #378C3F;
}

h1, .h1 {
  font-size: 3.5em;
  line-height: 1.15;
  margin-bottom: 30px;
}

h1 small, .h1 small {
  font-weight: 700;
  text-transform: uppercase;
  opacity: .8;
}

h2, .h2 {
  font-size: 2.5em;
  margin-bottom: 30px;
}

h3, .h3 {
  font-size: 2em;
  margin-bottom: 30px;
  line-height: 1.4em;
}

h4, .h4 {
  font-size: 1.714em;
  line-height: 1.45em;
  margin-top: 30px;
  margin-bottom: 15px;
}

h4 + .category,
h4.title + .category, .h4 + .category,
.h4.title + .category {
  margin-top: -10px;
}

h5, .h5 {
  font-size: 1.57em;
  line-height: 1.4em;
  margin-bottom: 15px;
}

h6, .h6 {
  font-size: 1em;
  font-weight: 700;
  text-transform: uppercase;
}

p {
  line-height: 1.61em;
}

.description p, p.description {
  font-size: 1.14em;
}

.title {
  font-weight: 700;
}

.title.title-up {
  text-transform: uppercase;
}

.title.title-up a {
  color: #2c2c2c;
  text-decoration: none;
}

.title + .category {
  margin-top: -25px;
}

.description,
.card-description,
.footer-big p {
  color: #9A9A9A;
  font-weight: 300;
}

.category {
  text-transform: uppercase;
  font-weight: 700;
  color: #9A9A9A;
}

.text-primary {
  color: #378C3F !important;
}

.text-info {
  color: #2CA8FF !important;
}

.text-success {
  color: #18ce0f !important;
}

.text-warning {
  color: #FFB236 !important;
}

.text-danger {
  color: #FF3636 !important;
}

.text-black {
  color: #444;
}

.blockquote {
  border-left: none;
  border: 1px solid #888;
  padding: 20px;
  font-size: 1.1em;
  line-height: 1.8;
}

.blockquote small {
  color: #888;
  font-size: 0.8571em;
  text-transform: uppercase;
}

.blockquote.blockquote-primary {
  border-color: #378C3F;
  color: #378C3F;
}

.blockquote.blockquote-primary small {
  color: #378C3F;
}

.blockquote.blockquote-danger {
  border-color: #FF3636;
  color: #FF3636;
}

.blockquote.blockquote-danger small {
  color: #FF3636;
}

.blockquote.blockquote-white {
  border-color: rgba(255, 255, 255, 0.8);
  color: #FFFFFF;
}

.blockquote.blockquote-white small {
  color: rgba(255, 255, 255, 0.8);
}

body {
  color: #2c2c2c;
  font-size: 14px;
  font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
}

.main {
  position: relative;
  background: #FFFFFF;
}

/* Animations */
.nav-pills .nav-link,
.nav-item .nav-link,
.navbar,
.nav-tabs .nav-link {
  -webkit-transition: all 300ms ease 0s;
  transition: all 300ms ease 0s;
}

.dropdown-toggle:after,
.bootstrap-switch-label:before {
  -webkit-transition: all 150ms ease 0s;
  transition: all 150ms ease 0s;
}

.dropdown-toggle[aria-expanded="true"]:after {
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2);
  -webkit-transform: rotate(180deg);
  transform: rotate(180deg);
}

.button-bar {
  display: block;
  position: relative;
  width: 22px;
  height: 1px;
  border-radius: 1px;
  background: #FFFFFF;
}

.button-bar + .button-bar {
  margin-top: 7px;
}

.button-bar:nth-child(2) {
  width: 17px;
}

.open {
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  opacity: 1;
  filter: alpha(opacity=100);
  visibility: visible;
}

.separator {
  height: 2px;
  width: 44px;
  background-color: #888;
  margin: 20px auto;
}

.separator.separator-primary {
  background-color: #378C3F;
}

.nav-pills .nav-item .nav-link {
  padding: 0 15.5px;
  text-align: center;
  height: 60px;
  width: 60px;
  font-weight: 400;
  color: #9A9A9A;
  margin-right: 19px;
  background-color: rgba(222, 222, 222, 0.3);
  border-radius: 30px;
}

.nav-pills .nav-item .nav-link:hover {
  background-color: rgba(222, 222, 222, 0.3);
}

.nav-pills .nav-item .nav-link.active, .nav-pills .nav-item .nav-link.active:focus, .nav-pills .nav-item .nav-link.active:hover {
  background-color: #9A9A9A;
  color: #FFFFFF;
  -webkit-box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
          box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
}

.nav-pills .nav-item .nav-link.disabled, .nav-pills .nav-item .nav-link:disabled, .nav-pills .nav-item .nav-link[disabled] {
  opacity: .5;
}

.nav-pills .nav-item i {
  display: block;
  font-size: 20px;
  line-height: 60px;
}

.nav-pills.nav-pills-neutral .nav-item .nav-link {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

.nav-pills.nav-pills-neutral .nav-item .nav-link.active, .nav-pills.nav-pills-neutral .nav-item .nav-link.active:focus, .nav-pills.nav-pills-neutral .nav-item .nav-link.active:hover {
  background-color: #FFFFFF;
  color: #378C3F;
}

.nav-pills.nav-pills-primary .nav-item .nav-link.active, .nav-pills.nav-pills-primary .nav-item .nav-link.active:focus, .nav-pills.nav-pills-primary .nav-item .nav-link.active:hover {
  background-color: #378C3F;
}

.nav-pills.nav-pills-info .nav-item .nav-link.active, .nav-pills.nav-pills-info .nav-item .nav-link.active:focus, .nav-pills.nav-pills-info .nav-item .nav-link.active:hover {
  background-color: #2CA8FF;
}

.nav-pills.nav-pills-success .nav-item .nav-link.active, .nav-pills.nav-pills-success .nav-item .nav-link.active:focus, .nav-pills.nav-pills-success .nav-item .nav-link.active:hover {
  background-color: #18ce0f;
}

.nav-pills.nav-pills-warning .nav-item .nav-link.active, .nav-pills.nav-pills-warning .nav-item .nav-link.active:focus, .nav-pills.nav-pills-warning .nav-item .nav-link.active:hover {
  background-color: #FFB236;
}

.nav-pills.nav-pills-danger .nav-item .nav-link.active, .nav-pills.nav-pills-danger .nav-item .nav-link.active:focus, .nav-pills.nav-pills-danger .nav-item .nav-link.active:hover {
  background-color: #FF3636;
}

.tab-space {
  padding: 20px 0 50px 0px;
}

.nav-align-center {
  text-align: center;
}

.nav-align-center .nav-pills {
  display: -webkit-inline-box;
  display: -ms-inline-flexbox;
  display: inline-flex;
}

.btn-twitter {
  color: #55acee;
}

.btn-twitter:hover, .btn-twitter:focus, .btn-twitter:active {
  color: #3ea1ec;
}

.btn-facebook {
  color: #3b5998;
}

.btn-facebook:hover, .btn-facebook:focus, .btn-facebook:active {
  color: #344e86;
}

.btn-google {
  color: #dd4b39;
}

.btn-google:hover, .btn-google:focus, .btn-google:active {
  color: #d73925;
}

.btn-linkedin {
  color: #0077B5;
}

.btn-linkedin:hover, .btn-linkedin:focus, .btn-linkedin:active {
  color: #00669c;
}

.nav-tabs {
  border: 0;
  padding: 15px 0.7rem;
}

.nav-tabs > .nav-item > .nav-link {
  color: #888;
  margin: 0;
  margin-right: 5px;
  background-color: transparent;
  border: 1px solid transparent;
  border-radius: 30px;
  font-size: 14px;
  padding: 11px 23px;
  line-height: 1.5;
}

.nav-tabs > .nav-item > .nav-link:hover {
  background-color: transparent;
}

.nav-tabs > .nav-item > .nav-link.active {
  border: 1px solid #888;
  border-radius: 30px;
}

.nav-tabs > .nav-item > .nav-link i.now-ui-icons {
  font-size: 14px;
  position: relative;
  top: 1px;
  margin-right: 3px;
}

.nav-tabs > .nav-item.disabled > .nav-link,
.nav-tabs > .nav-item.disabled > .nav-link:hover {
  color: rgba(255, 255, 255, 0.5);
}

.nav-tabs.nav-tabs-neutral > .nav-item > .nav-link {
  color: #FFFFFF;
}

.nav-tabs.nav-tabs-neutral > .nav-item > .nav-link.active {
  border-color: rgba(255, 255, 255, 0.5);
  color: #FFFFFF;
}

.nav-tabs.nav-tabs-primary > .nav-item > .nav-link.active {
  border-color: #378C3F;
  color: #378C3F;
}

.nav-tabs.nav-tabs-info > .nav-item > .nav-link.active {
  border-color: #2CA8FF;
  color: #2CA8FF;
}

.nav-tabs.nav-tabs-danger > .nav-item > .nav-link.active {
  border-color: #FF3636;
  color: #FF3636;
}

.nav-tabs.nav-tabs-warning > .nav-item > .nav-link.active {
  border-color: #FFB236;
  color: #FFB236;
}

.nav-tabs.nav-tabs-success > .nav-item > .nav-link.active {
  border-color: #18ce0f;
  color: #18ce0f;
}

.navbar {
  padding-top: 0.625rem;
  padding-bottom: 0.625rem;
  min-height: 53px;
  margin-bottom: 20px;
  -webkit-box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.15);
          box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.15);
}

.navbar a {
  vertical-align: middle;
}

.navbar a:not(.btn):not(.dropdown-item) {
  color: #FFFFFF;
}

.navbar p {
  display: inline-block;
  margin: 0;
  line-height: 21px;
}

.navbar .navbar-nav.navbar-logo {
  position: absolute;
  left: 0;
  right: 0;
  margin: 0 auto;
  width: 49px;
  top: -4px;
}

.navbar .navbar-nav .nav-link.btn {
  padding: 11px 22px;
}

.navbar .navbar-nav .nav-link.btn.btn-lg {
  padding: 15px 48px;
}

.navbar .navbar-nav .nav-link.btn.btn-sm {
  padding: 5px 15px;
}

.navbar .navbar-nav .nav-link:not(.btn) {
  text-transform: uppercase;
  font-size: 0.7142em;
  padding: 0.5rem 0.7rem;
  line-height: 1.625rem;
}

.navbar .navbar-nav .nav-link:not(.btn) i.fa + p,
.navbar .navbar-nav .nav-link:not(.btn) i.now-ui-icons + p {
  margin-left: 5px;
}

.navbar .navbar-nav .nav-link:not(.btn) i.fa,
.navbar .navbar-nav .nav-link:not(.btn) i.now-ui-icons {
  font-size: 18px;
  position: relative;
  top: 2px;
  text-align: center;
  width: 21px;
}

.navbar .navbar-nav .nav-link:not(.btn) i.now-ui-icons {
  top: 4px;
  font-size: 16px;
}

.navbar .navbar-nav .nav-link:not(.btn).profile-photo .profile-photo-small {
  width: 27px;
  height: 27px;
}

.navbar .navbar-nav .nav-link:not(.btn).disabled {
  opacity: .5;
  color: #FFFFFF;
}

.navbar .navbar-nav .nav-item.active .nav-link:not(.btn),
.navbar .navbar-nav .nav-item .nav-link:not(.btn):focus,
.navbar .navbar-nav .nav-item .nav-link:not(.btn):hover,
.navbar .navbar-nav .nav-item .nav-link:not(.btn):active {
  background-color: rgba(255, 255, 255, 0.2);
  border-radius: 0.1875rem;
}

.navbar .logo-container {
  width: 27px;
  height: 27px;
  overflow: hidden;
  margin: 0 auto;
  border-radius: 50%;
  border: 1px solid transparent;
}

.navbar .navbar-brand {
  text-transform: uppercase;
  font-size: 0.8571em;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  line-height: 1.625rem;
}

.navbar .navbar-toggler {
  width: 37px;
  height: 27px;
  outline: 0;
  cursor: pointer;
}

.navbar .navbar-toggler.navbar-toggler-left {
  position: relative;
  left: 0;
  padding-left: 0;
}

.navbar .navbar-toggler:hover .navbar-toggler-bar.bar2 {
  width: 22px;
}

.navbar .button-dropdown .navbar-toggler-bar:nth-child(2) {
  width: 17px;
}

.navbar.navbar-transparent {
  background-color: transparent !important;
  -webkit-box-shadow: none;
          box-shadow: none;
  color: #FFFFFF;
  padding-top: 20px;
}

.navbar.bg-white:not(.navbar-transparent) a:not(.dropdown-item) {
  color: #888;
}

.navbar.bg-white:not(.navbar-transparent) a:not(.dropdown-item).disabled {
  opacity: .5;
  color: #888;
}

.navbar.bg-white:not(.navbar-transparent) .button-bar {
  background: #888;
}

.navbar.bg-white:not(.navbar-transparent) .nav-item.active .nav-link:not(.btn),
.navbar.bg-white:not(.navbar-transparent) .nav-item .nav-link:not(.btn):focus,
.navbar.bg-white:not(.navbar-transparent) .nav-item .nav-link:not(.btn):hover,
.navbar.bg-white:not(.navbar-transparent) .nav-item .nav-link:not(.btn):active {
  background-color: rgba(222, 222, 222, 0.3);
}

.navbar.bg-white:not(.navbar-transparent) .logo-container {
  border: 1px solid #888;
}

.bg-default {
  background-color: #888 !important;
}

.bg-primary {
  background-color: #378C3F !important;
}

.bg-info {
  background-color: #2CA8FF !important;
}

.bg-success {
  background-color: #18ce0f !important;
}

.bg-danger {
  background-color: #FF3636 !important;
}

.bg-warning {
  background-color: #FFB236 !important;
}

.bg-white {
  background-color: #FFFFFF !important;
}

.dropdown-menu {
  border: 0;
  -webkit-box-shadow: 0px 10px 50px 0px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 10px 50px 0px rgba(0, 0, 0, 0.2);
  border-radius: 0.125rem;
  -webkit-transition: all 150ms linear;
  transition: all 150ms linear;
  font-size: 14px;
}

.dropdown-menu.dropdown-menu-right:before {
  left: auto;
  right: 10px;
}

.dropdown-menu:before {
  display: inline-block;
  position: absolute;
  width: 0;
  height: 0;
  vertical-align: middle;
  content: "";
  top: -5px;
  left: 10px;
  right: auto;
  color: #FFFFFF;
  border-bottom: .4em solid;
  border-right: .4em solid transparent;
  border-left: .4em solid transparent;
}

.dropdown-menu .dropdown-item {
  font-size: 0.8571em;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  -webkit-transition: all 150ms linear;
  transition: all 150ms linear;
}

.dropdown-menu .dropdown-item:hover, .dropdown-menu .dropdown-item:focus {
  background-color: rgba(222, 222, 222, 0.3);
}

.dropdown-menu .dropdown-divider {
  background-color: rgba(222, 222, 222, 0.5);
}

.dropdown-menu .dropdown-header:not([href]):not([tabindex]) {
  color: rgba(182, 182, 182, 0.6);
  font-size: 0.7142em;
  text-transform: uppercase;
  font-weight: 700;
}

.dropdown-menu.dropdown-primary {
  background-color: #33813a;
}

.dropdown-menu.dropdown-primary:before {
  color: #33813a;
}

.dropdown-menu.dropdown-primary .dropdown-header:not([href]):not([tabindex]) {
  color: rgba(255, 255, 255, 0.8);
}

.dropdown-menu.dropdown-primary .dropdown-item {
  color: #FFFFFF;
}

.dropdown-menu.dropdown-primary .dropdown-item:hover, .dropdown-menu.dropdown-primary .dropdown-item:focus {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-primary .dropdown-divider {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-info {
  background-color: #1da2ff;
}

.dropdown-menu.dropdown-info:before {
  color: #1da2ff;
}

.dropdown-menu.dropdown-info .dropdown-header:not([href]):not([tabindex]) {
  color: rgba(255, 255, 255, 0.8);
}

.dropdown-menu.dropdown-info .dropdown-item {
  color: #FFFFFF;
}

.dropdown-menu.dropdown-info .dropdown-item:hover, .dropdown-menu.dropdown-info .dropdown-item:focus {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-info .dropdown-divider {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-danger {
  background-color: #ff2727;
}

.dropdown-menu.dropdown-danger:before {
  color: #ff2727;
}

.dropdown-menu.dropdown-danger .dropdown-header:not([href]):not([tabindex]) {
  color: rgba(255, 255, 255, 0.8);
}

.dropdown-menu.dropdown-danger .dropdown-item {
  color: #FFFFFF;
}

.dropdown-menu.dropdown-danger .dropdown-item:hover, .dropdown-menu.dropdown-danger .dropdown-item:focus {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-danger .dropdown-divider {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-success {
  background-color: #16c00e;
}

.dropdown-menu.dropdown-success:before {
  color: #16c00e;
}

.dropdown-menu.dropdown-success .dropdown-header:not([href]):not([tabindex]) {
  color: rgba(255, 255, 255, 0.8);
}

.dropdown-menu.dropdown-success .dropdown-item {
  color: #FFFFFF;
}

.dropdown-menu.dropdown-success .dropdown-item:hover, .dropdown-menu.dropdown-success .dropdown-item:focus {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-success .dropdown-divider {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-warning {
  background-color: #ffac27;
}

.dropdown-menu.dropdown-warning:before {
  color: #ffac27;
}

.dropdown-menu.dropdown-warning .dropdown-header:not([href]):not([tabindex]) {
  color: rgba(255, 255, 255, 0.8);
}

.dropdown-menu.dropdown-warning .dropdown-item {
  color: #FFFFFF;
}

.dropdown-menu.dropdown-warning .dropdown-item:hover, .dropdown-menu.dropdown-warning .dropdown-item:focus {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown-menu.dropdown-warning .dropdown-divider {
  background-color: rgba(255, 255, 255, 0.2);
}

.dropdown .dropdown-menu {
  -webkit-transform: translate3d(0, -25px, 0);
  transform: translate3d(0, -25px, 0);
  visibility: hidden;
  display: block;
  opacity: 0;
  filter: alpha(opacity=0);
}

.dropdown.show .dropdown-menu, .dropdown-menu.open {
  opacity: 1;
  filter: alpha(opacity=100);
  visibility: visible;
  -webkit-transform: translate3d(0, 0px, 0);
  transform: translate3d(0, 0px, 0);
}

.navbar .dropdown.show .dropdown-menu {
  -webkit-transform: translate3d(0, 7px, 0);
  transform: translate3d(0, 7px, 0);
}

.button-dropdown {
  padding-right: 0.7rem;
  cursor: pointer;
}

.button-dropdown .dropdown-toggle {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  display: block;
}

.button-dropdown .dropdown-toggle:after {
  display: none;
}

.alert {
  border: 0;
  border-radius: 0;
  color: #FFFFFF;
  padding-top: .9rem;
  padding-bottom: .9rem;
  position: relative;
}

.alert.alert-success {
  background-color: rgba(24, 206, 15, 0.8);
}

.alert.alert-danger {
  background-color: rgba(255, 54, 54, 0.8);
}

.alert.alert-warning {
  background-color: rgba(255, 178, 54, 0.8);
}

.alert.alert-info {
  background-color: rgba(44, 168, 255, 0.8);
}

.alert.alert-primary {
  background-color: rgba(249, 99, 50, 0.8);
}

.alert .alert-icon {
  display: block;
  float: left;
  margin-right: 15px;
  margin-top: -1px;
}

.alert strong {
  text-transform: uppercase;
  font-size: 12px;
}

.alert i.fa,
.alert i.now-ui-icons {
  font-size: 20px;
}

.alert .close {
  color: #FFFFFF;
  opacity: .9;
  text-shadow: none;
  line-height: 0;
  outline: 0;
}

img {
  max-width: 100%;
  border-radius: 1px;
}

.img-raised {
  -webkit-box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.3);
          box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.3);
}

.popover {
  font-size: 14px;
  -webkit-box-shadow: 0px 10px 50px 0px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 10px 50px 0px rgba(0, 0, 0, 0.2);
  border: none;
  line-height: 1.7;
  max-width: 240px;
}

.popover.bs-popover-top .arrow:before,
.popover.bs-popover-left .arrow:before,
.popover.bs-popover-right .arrow:before,
.popover.bs-popover-bottom .arrow:before {
  border-top-color: transparent;
  border-left-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;
}

.popover .popover-header {
  color: rgba(182, 182, 182, 0.6);
  font-size: 14px;
  text-transform: capitalize;
  font-weight: 600;
  margin: 0;
  margin-top: 5px;
  border: none;
  background-color: transparent;
}

.popover:before {
  display: none;
}

.popover.bs-tether-element-attached-top:after {
  border-bottom-color: #FFFFFF;
  top: -9px;
}

.popover.popover-primary {
  background-color: #378C3F;
}

.popover.popover-primary .popover-body {
  color: #FFFFFF;
}

.popover.popover-primary.bs-popover-right .arrow:after {
  border-right-color: #378C3F;
}

.popover.popover-primary.bs-popover-top .arrow:after {
  border-top-color: #378C3F;
}

.popover.popover-primary.bs-popover-bottom .arrow:after {
  border-bottom-color: #378C3F;
}

.popover.popover-primary.bs-popover-left .arrow:after {
  border-left-color: #378C3F;
}

.popover.popover-primary .popover-header {
  color: #FFFFFF;
  opacity: .6;
}

.popover.popover-info {
  background-color: #2CA8FF;
}

.popover.popover-info .popover-body {
  color: #FFFFFF;
}

.popover.popover-info.bs-popover-right .arrow:after {
  border-right-color: #2CA8FF;
}

.popover.popover-info.bs-popover-top .arrow:after {
  border-top-color: #2CA8FF;
}

.popover.popover-info.bs-popover-bottom .arrow:after {
  border-bottom-color: #2CA8FF;
}

.popover.popover-info.bs-popover-left .arrow:after {
  border-left-color: #2CA8FF;
}

.popover.popover-info .popover-header {
  color: #FFFFFF;
  opacity: .6;
}

.popover.popover-warning {
  background-color: #FFB236;
}

.popover.popover-warning .popover-body {
  color: #FFFFFF;
}

.popover.popover-warning.bs-popover-right .arrow:after {
  border-right-color: #FFB236;
}

.popover.popover-warning.bs-popover-top .arrow:after {
  border-top-color: #FFB236;
}

.popover.popover-warning.bs-popover-bottom .arrow:after {
  border-bottom-color: #FFB236;
}

.popover.popover-warning.bs-popover-left .arrow:after {
  border-left-color: #FFB236;
}

.popover.popover-warning .popover-header {
  color: #FFFFFF;
  opacity: .6;
}

.popover.popover-danger {
  background-color: #FF3636;
}

.popover.popover-danger .popover-body {
  color: #FFFFFF;
}

.popover.popover-danger.bs-popover-right .arrow:after {
  border-right-color: #FF3636;
}

.popover.popover-danger.bs-popover-top .arrow:after {
  border-top-color: #FF3636;
}

.popover.popover-danger.bs-popover-bottom .arrow:after {
  border-bottom-color: #FF3636;
}

.popover.popover-danger.bs-popover-left .arrow:after {
  border-left-color: #FF3636;
}

.popover.popover-danger .popover-header {
  color: #FFFFFF;
  opacity: .6;
}

.popover.popover-success {
  background-color: #18ce0f;
}

.popover.popover-success .popover-body {
  color: #FFFFFF;
}

.popover.popover-success.bs-popover-right .arrow:after {
  border-right-color: #18ce0f;
}

.popover.popover-success.bs-popover-top .arrow:after {
  border-top-color: #18ce0f;
}

.popover.popover-success.bs-popover-bottom .arrow:after {
  border-bottom-color: #18ce0f;
}

.popover.popover-success.bs-popover-left .arrow:after {
  border-left-color: #18ce0f;
}

.popover.popover-success .popover-header {
  color: #FFFFFF;
  opacity: .6;
}

.tooltip.bs-tooltip-right .arrow:before {
  border-right-color: #FFFFFF;
}

.tooltip.bs-tooltip-top .arrow:before {
  border-top-color: #FFFFFF;
}

.tooltip.bs-tooltip-bottom .arrow:before {
  border-bottom-color: #FFFFFF;
}

.tooltip.bs-tooltip-left .arrow:before {
  border-left-color: #FFFFFF;
}

.tooltip-inner {
  padding: 0.5rem 0.7rem;
  min-width: 130px;
  background-color: #FFFFFF;
  font-size: 14px;
  color: inherit;
  -webkit-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
}

/* --------------------------------

Nucleo Outline Web Font - nucleoapp.com/
License - nucleoapp.com/license/
Created using IcoMoon - icomoon.io

-------------------------------- */
@font-face {
  font-family: 'Nucleo Outline';
  src: url("../fonts/nucleo-outline.eot");
  src: url("../fonts/nucleo-outline.eot") format("embedded-opentype"), url("../fonts/nucleo-outline.woff2") format("woff2"), url("../fonts/nucleo-outline.woff") format("woff"), url("../fonts/nucleo-outline.ttf") format("truetype");
  font-weight: normal;
  font-style: normal;
}

/*------------------------
    base class definition
-------------------------*/
.now-ui-icons {
  display: inline-block;
  font: normal normal normal 14px/1 'Nucleo Outline';
  font-size: inherit;
  speak: none;
  text-transform: none;
  /* Better Font Rendering */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

/*------------------------
  change icon size
-------------------------*/
/*----------------------------------
  add a square/circle background
-----------------------------------*/
.now-ui-icons.circle {
  padding: 0.33333333em;
  vertical-align: -16%;
  background-color: #eee;
}

.now-ui-icons.circle {
  border-radius: 50%;
}

/*------------------------
  list icons
-------------------------*/
.nc-icon-ul {
  padding-left: 0;
  margin-left: 2.14285714em;
  list-style-type: none;
}

.nc-icon-ul > li {
  position: relative;
}

.nc-icon-ul > li > .now-ui-icons {
  position: absolute;
  left: -1.57142857em;
  top: 0.14285714em;
  text-align: center;
}

.nc-icon-ul > li > .now-ui-icons.circle {
  top: -0.19047619em;
  left: -1.9047619em;
}

/*------------------------
  spinning icons
-------------------------*/
.now-ui-icons.spin {
  -webkit-animation: nc-icon-spin 2s infinite linear;
  animation: nc-icon-spin 2s infinite linear;
}

@-webkit-keyframes nc-icon-spin {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes nc-icon-spin {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

/*------------------------
  rotated/flipped icons
-------------------------*/
/*------------------------
    font icons
-------------------------*/
.now-ui-icons.ui-1_check:before {
  content: "\ea22";
}

.now-ui-icons.ui-1_email-85:before {
  content: "\ea2a";
}

.now-ui-icons.arrows-1_cloud-download-93:before {
  content: "\ea21";
}

.now-ui-icons.arrows-1_cloud-upload-94:before {
  content: "\ea24";
}

.now-ui-icons.arrows-1_minimal-down:before {
  content: "\ea39";
}

.now-ui-icons.arrows-1_minimal-left:before {
  content: "\ea3a";
}

.now-ui-icons.arrows-1_minimal-right:before {
  content: "\ea3b";
}

.now-ui-icons.arrows-1_minimal-up:before {
  content: "\ea3c";
}

.now-ui-icons.arrows-1_refresh-69:before {
  content: "\ea44";
}

.now-ui-icons.arrows-1_share-66:before {
  content: "\ea4c";
}

.now-ui-icons.business_badge:before {
  content: "\ea09";
}

.now-ui-icons.business_bank:before {
  content: "\ea0a";
}

.now-ui-icons.business_briefcase-24:before {
  content: "\ea13";
}

.now-ui-icons.business_bulb-63:before {
  content: "\ea15";
}

.now-ui-icons.business_chart-bar-32:before {
  content: "\ea1e";
}

.now-ui-icons.business_chart-pie-36:before {
  content: "\ea1f";
}

.now-ui-icons.business_globe:before {
  content: "\ea2f";
}

.now-ui-icons.business_money-coins:before {
  content: "\ea40";
}

.now-ui-icons.clothes_tie-bow:before {
  content: "\ea5b";
}

.now-ui-icons.design_vector:before {
  content: "\ea61";
}

.now-ui-icons.design_app:before {
  content: "\ea08";
}

.now-ui-icons.design_bullet-list-67:before {
  content: "\ea14";
}

.now-ui-icons.design_image:before {
  content: "\ea33";
}

.now-ui-icons.design_palette:before {
  content: "\ea41";
}

.now-ui-icons.design_scissors:before {
  content: "\ea4a";
}

.now-ui-icons.design-2_html5:before {
  content: "\ea32";
}

.now-ui-icons.design-2_ruler-pencil:before {
  content: "\ea48";
}

.now-ui-icons.emoticons_satisfied:before {
  content: "\ea49";
}

.now-ui-icons.files_box:before {
  content: "\ea12";
}

.now-ui-icons.files_paper:before {
  content: "\ea43";
}

.now-ui-icons.files_single-copy-04:before {
  content: "\ea52";
}

.now-ui-icons.health_ambulance:before {
  content: "\ea07";
}

.now-ui-icons.loader_gear:before {
  content: "\ea4e";
}

.now-ui-icons.loader_refresh:before {
  content: "\ea44";
}

.now-ui-icons.location_bookmark:before {
  content: "\ea10";
}

.now-ui-icons.location_compass-05:before {
  content: "\ea25";
}

.now-ui-icons.location_map-big:before {
  content: "\ea3d";
}

.now-ui-icons.location_pin:before {
  content: "\ea47";
}

.now-ui-icons.location_world:before {
  content: "\ea63";
}

.now-ui-icons.media-1_album:before {
  content: "\ea02";
}

.now-ui-icons.media-1_button-pause:before {
  content: "\ea16";
}

.now-ui-icons.media-1_button-play:before {
  content: "\ea18";
}

.now-ui-icons.media-1_button-power:before {
  content: "\ea19";
}

.now-ui-icons.media-1_camera-compact:before {
  content: "\ea1c";
}

.now-ui-icons.media-2_note-03:before {
  content: "\ea3f";
}

.now-ui-icons.media-2_sound-wave:before {
  content: "\ea57";
}

.now-ui-icons.objects_diamond:before {
  content: "\ea29";
}

.now-ui-icons.objects_globe:before {
  content: "\ea2f";
}

.now-ui-icons.objects_key-25:before {
  content: "\ea38";
}

.now-ui-icons.objects_planet:before {
  content: "\ea46";
}

.now-ui-icons.objects_spaceship:before {
  content: "\ea55";
}

.now-ui-icons.objects_support-17:before {
  content: "\ea56";
}

.now-ui-icons.objects_umbrella-13:before {
  content: "\ea5f";
}

.now-ui-icons.education_agenda-bookmark:before {
  content: "\ea01";
}

.now-ui-icons.education_atom:before {
  content: "\ea0c";
}

.now-ui-icons.education_glasses:before {
  content: "\ea2d";
}

.now-ui-icons.education_hat:before {
  content: "\ea30";
}

.now-ui-icons.education_paper:before {
  content: "\ea42";
}

.now-ui-icons.shopping_bag-16:before {
  content: "\ea0d";
}

.now-ui-icons.shopping_basket:before {
  content: "\ea0b";
}

.now-ui-icons.shopping_box:before {
  content: "\ea11";
}

.now-ui-icons.shopping_cart-simple:before {
  content: "\ea1d";
}

.now-ui-icons.shopping_credit-card:before {
  content: "\ea28";
}

.now-ui-icons.shopping_delivery-fast:before {
  content: "\ea27";
}

.now-ui-icons.shopping_shop:before {
  content: "\ea50";
}

.now-ui-icons.shopping_tag-content:before {
  content: "\ea59";
}

.now-ui-icons.sport_trophy:before {
  content: "\ea5d";
}

.now-ui-icons.sport_user-run:before {
  content: "\ea60";
}

.now-ui-icons.tech_controller-modern:before {
  content: "\ea26";
}

.now-ui-icons.tech_headphones:before {
  content: "\ea31";
}

.now-ui-icons.tech_laptop:before {
  content: "\ea36";
}

.now-ui-icons.tech_mobile:before {
  content: "\ea3e";
}

.now-ui-icons.tech_tablet:before {
  content: "\ea58";
}

.now-ui-icons.tech_tv:before {
  content: "\ea5e";
}

.now-ui-icons.tech_watch-time:before {
  content: "\ea62";
}

.now-ui-icons.text_align-center:before {
  content: "\ea05";
}

.now-ui-icons.text_align-left:before {
  content: "\ea06";
}

.now-ui-icons.text_bold:before {
  content: "\ea0e";
}

.now-ui-icons.text_caps-small:before {
  content: "\ea1b";
}

.now-ui-icons.gestures_tap-01:before {
  content: "\ea5a";
}

.now-ui-icons.transportation_air-baloon:before {
  content: "\ea03";
}

.now-ui-icons.transportation_bus-front-12:before {
  content: "\ea17";
}

.now-ui-icons.travel_info:before {
  content: "\ea04";
}

.now-ui-icons.travel_istanbul:before {
  content: "\ea34";
}

.now-ui-icons.ui-1_bell-53:before {
  content: "\ea0f";
}

.now-ui-icons.ui-1_calendar-60:before {
  content: "\ea1a";
}

.now-ui-icons.ui-1_lock-circle-open:before {
  content: "\ea35";
}

.now-ui-icons.ui-1_send:before {
  content: "\ea4d";
}

.now-ui-icons.ui-1_settings-gear-63:before {
  content: "\ea4e";
}

.now-ui-icons.ui-1_simple-add:before {
  content: "\ea4f";
}

.now-ui-icons.ui-1_simple-delete:before {
  content: "\ea54";
}

.now-ui-icons.ui-1_simple-remove:before {
  content: "\ea53";
}

.now-ui-icons.ui-1_zoom-bold:before {
  content: "\ea64";
}

.now-ui-icons.ui-2_chat-round:before {
  content: "\ea20";
}

.now-ui-icons.ui-2_favourite-28:before {
  content: "\ea2b";
}

.now-ui-icons.ui-2_like:before {
  content: "\ea37";
}

.now-ui-icons.ui-2_settings-90:before {
  content: "\ea4b";
}

.now-ui-icons.ui-2_time-alarm:before {
  content: "\ea5c";
}

.now-ui-icons.users_circle-08:before {
  content: "\ea23";
}

.now-ui-icons.users_single-02:before {
  content: "\ea51";
}

.modal-content {
  border-radius: 0.1875rem;
  border: none;
  -webkit-box-shadow: 0px 10px 50px 0px rgba(0, 0, 0, 0.5);
          box-shadow: 0px 10px 50px 0px rgba(0, 0, 0, 0.5);
}

.modal-content .modal-header {
  border-bottom: none;
  padding-top: 24px;
  padding-right: 24px;
  padding-bottom: 0;
  padding-left: 24px;
}

.modal-content .modal-header button {
  position: absolute;
  right: 27px;
  top: 30px;
  outline: 0;
}

.modal-content .modal-header .title {
  margin-top: 5px;
  margin-bottom: 0;
}

.modal-content .modal-body {
  padding-top: 24px;
  padding-right: 24px;
  padding-bottom: 16px;
  padding-left: 24px;
  line-height: 1.9;
}

.modal-content .modal-footer {
  border-top: none;
  padding-right: 24px;
  padding-bottom: 16px;
  padding-left: 24px;
  /* Safari 6.1+ */
  -webkit-box-pack: justify;
      -ms-flex-pack: justify;
          justify-content: space-between;
}

.modal-content .modal-footer button {
  margin: 0;
  padding-left: 16px;
  padding-right: 16px;
  width: auto;
}

.modal-content .modal-footer button.pull-left {
  padding-left: 5px;
  padding-right: 5px;
  position: relative;
  left: -5px;
}

.modal-content .modal-body + .modal-footer {
  padding-top: 0;
}

.modal-backdrop {
  background: rgba(0, 0, 0, 0.3);
}

.modal.modal-mini p {
  text-align: center;
}

.modal.modal-mini .modal-dialog {
  max-width: 255px;
  margin: 0 auto;
}

.modal.modal-mini .modal-profile {
  width: 70px;
  height: 70px;
  background-color: #FFFFFF;
  border-radius: 50%;
  text-align: center;
  line-height: 5.9;
  -webkit-box-shadow: 0px 5px 50px 0px rgba(0, 0, 0, 0.3);
          box-shadow: 0px 5px 50px 0px rgba(0, 0, 0, 0.3);
}

.modal.modal-mini .modal-profile i {
  color: #378C3F;
  font-size: 21px;
}

.modal.modal-mini .modal-profile[class*="modal-profile-"] i {
  color: #FFFFFF;
}

.modal.modal-mini .modal-profile.modal-profile-primary {
  background-color: #378C3F;
}

.modal.modal-mini .modal-profile.modal-profile-danger {
  background-color: #FF3636;
}

.modal.modal-mini .modal-profile.modal-profile-warning {
  background-color: #FFB236;
}

.modal.modal-mini .modal-profile.modal-profile-success {
  background-color: #18ce0f;
}

.modal.modal-mini .modal-profile.modal-profile-info {
  background-color: #2CA8FF;
}

.modal.modal-mini .modal-footer button {
  text-transform: uppercase;
}

.modal.modal-mini .modal-footer button:first-child {
  opacity: .5;
}

.modal.modal-default .modal-content {
  background-color: #FFFFFF;
  color: #2c2c2c;
}

.modal.modal-default .modal-header .close {
  color: #2c2c2c;
}

.modal.modal-primary .modal-content {
  background-color: #378C3F;
  color: #FFFFFF;
}

.modal.modal-primary .modal-header .close {
  color: #FFFFFF;
}

.modal.modal-danger .modal-content {
  background-color: #FF3636;
  color: #FFFFFF;
}

.modal.modal-danger .modal-header .close {
  color: #FFFFFF;
}

.modal.modal-warning .modal-content {
  background-color: #FFB236;
  color: #FFFFFF;
}

.modal.modal-warning .modal-header .close {
  color: #FFFFFF;
}

.modal.modal-success .modal-content {
  background-color: #18ce0f;
  color: #FFFFFF;
}

.modal.modal-success .modal-header .close {
  color: #FFFFFF;
}

.modal.modal-info .modal-content {
  background-color: #2CA8FF;
  color: #FFFFFF;
}

.modal.modal-info .modal-header .close {
  color: #FFFFFF;
}

.modal.show.modal-mini .modal-dialog {
  -webkit-transform: translate(0, 30%);
  transform: translate(0, 30%);
}

.modal .modal-header .close {
  color: #FF3636;
  text-shadow: none;
}

.modal .modal-header .close:hover, .modal .modal-header .close:focus {
  opacity: 1;
}

.carousel-item-next,
.carousel-item-prev,
.carousel-item.active {
  display: block;
}

.carousel .carousel-inner {
  -webkit-box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.3);
          box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.3);
}

.carousel .now-ui-icons {
  font-size: 2em;
}

.card {
  border: 0;
  border-radius: 0.1875rem;
  display: inline-block;
  position: relative;
  overflow: hidden;
  width: 100%;
  margin-bottom: 20px;
  -webkit-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
}

.card .card-body {
  min-height: 190px;
}

.card[data-background-color="orange"] {
  background-color: #378C3F;
}

.card[data-background-color="red"] {
  background-color: #FF3636;
}

.card[data-background-color="yellow"] {
  background-color: #FFB236;
}

.card[data-background-color="blue"] {
  background-color: #2CA8FF;
}

.card[data-background-color="green"] {
  background-color: #18ce0f;
}

.card-signup {
  max-width: 350px;
  margin: 0 auto;
}

.card-signup .header {
  margin-left: 20px;
  margin-right: 20px;
  padding: 30px 0;
}

.card-signup .text-divider {
  margin-top: 30px;
  margin-bottom: 0px;
  text-align: center;
}

.card-signup .card-body {
  padding-top: 0px;
  padding-bottom: 0px;
  min-height: auto;
}

.card-signup .checkbox {
  margin-top: 20px;
}

.card-signup .checkbox label {
  margin-left: 17px;
}

.card-signup .checkbox .checkbox-material {
  padding-right: 12px;
}

.card-signup .social-line {
  margin-top: 20px;
  text-align: center;
}

.card-signup .social-line .btn.btn-icon,
.card-signup .social-line .btn.btn-icon .btn-icon -mini {
  margin-left: 5px;
  margin-right: 5px;
  -webkit-box-shadow: 0px 5px 50px 0px rgba(0, 0, 0, 0.2);
          box-shadow: 0px 5px 50px 0px rgba(0, 0, 0, 0.2);
}

.card-signup .footer {
  margin-bottom: 10px;
  margin-top: 24px;
}

.card-plain {
  background: transparent;
  -webkit-box-shadow: none;
          box-shadow: none;
}

.card-plain .header {
  margin-left: 0;
  margin-right: 0;
}

.card-plain .content {
  padding-left: 0;
  padding-right: 0;
}

.footer {
  padding: 24px 0;
}

.footer.footer-default {
  background-color: #f2f2f2;
}

.footer nav {
  display: inline-block;
  float: left;
}

.footer ul {
  margin-bottom: 0;
  padding: 0;
  list-style: none;
}

.footer ul li {
  display: inline-block;
}

.footer ul li a {
  color: inherit;
  padding: 0.5rem;
  font-size: 0.8571em;
  text-transform: uppercase;
  text-decoration: none;
}

.footer ul li a:hover {
  text-decoration: none;
}

.footer .copyright {
  font-size: 0.8571em;
}

.footer:after {
  display: table;
  clear: both;
  content: " ";
}

.index-page .page-header {
  height: 125vh;
}

.index-page .page-header .container > .content-center {
  top: 37%;
}

.index-page .page-header .category-absolute {
  position: absolute;
  top: 100vh;
  margin-top: -60px;
  padding: 0 15px;
  width: 100%;
  color: rgba(255, 255, 255, 0.5);
}

.landing-page .header {
  height: 100vh;
  position: relative;
}

.landing-page .header .container {
  padding-top: 26vh;
  color: #FFFFFF;
  z-index: 2;
  position: relative;
}

.landing-page .header .share {
  margin-top: 150px;
}

.landing-page .header h1 {
  font-weight: 600;
}

.landing-page .header .title {
  color: #FFFFFF;
}

.landing-page .section-team .team .team-player img {
  max-width: 100px;
}

.landing-page .section-team .team-player {
  margin-bottom: 15px;
}

.landing-page .section-contact-us .title {
  margin-bottom: 15px;
}

.landing-page .section-contact-us .description {
  margin-bottom: 30px;
}

.landing-page .section-contact-us .input-group,
.landing-page .section-contact-us .send-button,
.landing-page .section-contact-us .textarea-container {
  padding: 0 40px;
}

.landing-page .section-contact-us .textarea-container {
  margin: 40px 0;
}

.landing-page .section-contact-us a.btn {
  margin-top: 35px;
}

.profile-page .page-header {
  min-height: 550px;
}

.profile-page .profile-container {
  color: #FFFFFF;
}

.profile-page .photo-container {
  width: 123px;
  height: 123px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto;
  -webkit-box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.3);
          box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.3);
}

.profile-page .title {
  text-align: center;
  margin-top: 30px;
}

.profile-page .description,
.profile-page .category {
  text-align: center;
}

.profile-page h5.description {
  max-width: 700px;
  margin: 20px auto 75px;
}

.profile-page .nav-align-center {
  margin-top: 30px;
}

.profile-page .content {
  max-width: 450px;
  margin: 0 auto;
}

.profile-page .content .social-description {
  display: inline-block;
  max-width: 150px;
  width: 145px;
  text-align: center;
  margin: 15px 0 0px;
}

.profile-page .content .social-description h2 {
  margin-bottom: 15px;
}

.profile-page .button-container {
  text-align: center;
  margin-top: -106px;
}

.profile-page .collections img {
  margin-bottom: 30px;
}

.profile-page .gallery {
  margin-top: 45px;
  padding-bottom: 50px;
}

.section-full-page:after, .section-full-page:before {
  display: block;
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 2;
}

.section-full-page:before {
  background-color: rgba(0, 0, 0, 0.5);
}

.section-full-page[filter-color="purple"]:after, .section-full-page[filter-color="primary"]:after {
  background: rgba(227, 227, 227, 0.26);
  /* For browsers that do not support gradients */
  /* For Safari 5.1 to 6.0 */
  /* For Opera 11.1 to 12.0 */
  /* For Firefox 3.6 to 15 */
  background: -webkit-gradient(linear, left bottom, left top, from(rgba(227, 227, 227, 0.26)), to(rgba(55, 140, 63, 0.95)));
  background: linear-gradient(0deg, rgba(227, 227, 227, 0.26), rgba(55, 140, 63, 0.95));
  /* Standard syntax */
}

.section-full-page[data-image]:after {
  opacity: .5;
}

.section-full-page > .content,
.section-full-page > .footer {
  position: relative;
  z-index: 4;
}

.section-full-page > .content {
  min-height: calc(100vh - 80px);
}

.section-full-page .full-page-background {
  position: absolute;
  z-index: 1;
  height: 100%;
  width: 100%;
  display: block;
  top: 0;
  left: 0;
  background-size: cover;
  background-position: center center;
}

.section-full-page .footer nav > ul a:not(.btn),
.section-full-page .footer,
.section-full-page .footer .copyright a {
  color: #FFFFFF;
}

.login-page .card-login {
  border-radius: 0.25rem;
  padding-bottom: 0.7rem;
  max-width: 320px;
}

.login-page .card-login .btn-wd {
  min-width: 180px;
}

.login-page .card-login .logo-container {
  width: 65px;
  margin: 0 auto;
  margin-bottom: 55px;
}

.login-page .card-login .logo-container img {
  width: 100%;
}

.login-page .card-login .input-group:last-child {
  margin-bottom: 40px;
}

.login-page .card-login.card-plain .form-control::-moz-placeholder {
  color: #ebebeb;
  opacity: 1;
  filter: alpha(opacity=100);
}

.login-page .card-login.card-plain .form-control:-moz-placeholder {
  color: #ebebeb;
  opacity: 1;
  filter: alpha(opacity=100);
}

.login-page .card-login.card-plain .form-control::-webkit-input-placeholder {
  color: #ebebeb;
  opacity: 1;
  filter: alpha(opacity=100);
}

.login-page .card-login.card-plain .form-control:-ms-input-placeholder {
  color: #ebebeb;
  opacity: 1;
  filter: alpha(opacity=100);
}

.login-page .card-login.card-plain .form-control {
  border-color: rgba(255, 255, 255, 0.5);
  color: #FFFFFF;
}

.login-page .card-login.card-plain .form-control:focus {
  border-color: #FFFFFF;
  background-color: transparent;
  color: #FFFFFF;
}

.login-page .card-login.card-plain .has-success:after,
.login-page .card-login.card-plain .has-danger:after {
  color: #FFFFFF;
}

.login-page .card-login.card-plain .has-danger .form-control {
  background-color: transparent;
}

.login-page .card-login.card-plain .input-group-addon {
  background-color: transparent;
  border-color: rgba(255, 255, 255, 0.5);
  color: #FFFFFF;
}

.login-page .card-login.card-plain .input-group-focus .input-group-addon {
  background-color: transparent;
  border-color: #FFFFFF;
  color: #FFFFFF;
}

.login-page .card-login.card-plain .form-group.form-group-no-border .form-control,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control {
  background-color: rgba(255, 255, 255, 0.1);
  color: #FFFFFF;
}

.login-page .card-login.card-plain .form-group.form-group-no-border .form-control:focus, .login-page .card-login.card-plain .form-group.form-group-no-border .form-control:active, .login-page .card-login.card-plain .form-group.form-group-no-border .form-control:active,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control:focus,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control:active,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control:active {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

.login-page .card-login.card-plain .form-group.form-group-no-border .form-control + .input-group-addon,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control + .input-group-addon {
  background-color: rgba(255, 255, 255, 0.1);
}

.login-page .card-login.card-plain .form-group.form-group-no-border .form-control + .input-group-addon:focus, .login-page .card-login.card-plain .form-group.form-group-no-border .form-control + .input-group-addon:active, .login-page .card-login.card-plain .form-group.form-group-no-border .form-control + .input-group-addon:active,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control + .input-group-addon:focus,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control + .input-group-addon:active,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control + .input-group-addon:active {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

.login-page .card-login.card-plain .form-group.form-group-no-border .form-control:focus + .input-group-addon,
.login-page .card-login.card-plain .input-group.form-group-no-border .form-control:focus + .input-group-addon {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

.login-page .card-login.card-plain .form-group.form-group-no-border .input-group-addon,
.login-page .card-login.card-plain .input-group.form-group-no-border .input-group-addon {
  background-color: rgba(255, 255, 255, 0.1);
  border: none;
  color: #FFFFFF;
}

.login-page .card-login.card-plain .form-group.form-group-no-border.input-group-focus .input-group-addon,
.login-page .card-login.card-plain .input-group.form-group-no-border.input-group-focus .input-group-addon {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

.login-page .card-login.card-plain .input-group-addon,
.login-page .card-login.card-plain .form-group.form-group-no-border .input-group-addon,
.login-page .card-login.card-plain .input-group.form-group-no-border .input-group-addon {
  color: rgba(255, 255, 255, 0.8);
}

.login-page .link {
  font-size: 10px;
  color: #FFFFFF;
  text-decoration: none;
}

.section {
  padding: 70px 0;
  position: relative;
  background: #FFFFFF;
}

.section .row + .category {
  margin-top: 15px;
}

.section-navbars {
  padding-bottom: 0;
}

.section-full-screen {
  height: 100vh;
}

.section-signup {
  padding-top: 20vh;
}

.page-header {
  height: 100vh;
  max-height: 1050px;
  padding: 0;
  color: #FFFFFF;
  position: relative;
  background-position: center center;
  background-size: cover;
}

.page-header .page-header-image {
  position: absolute;
  background-size: cover;
  background-position: center center;
  width: 100%;
  height: 100%;
  z-index: -1;
}

.page-header footer {
  position: absolute;
  bottom: 0;
  width: 100%;
}

.page-header .container {
  height: 100%;
  z-index: 1;
  text-align: center;
  position: relative;
}

.page-header .container > .content-center {
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
  padding: 0 15px;
  color: #FFFFFF;
  width: 100%;
  max-width: 880px;
}

.page-header .category,
.page-header .description {
  color: rgba(255, 255, 255, 0.5);
}

.page-header.page-header-small {
  height: 60vh;
  max-height: 440px;
}

.page-header:after, .page-header:before {
  position: absolute;
  z-index: 0;
  width: 100%;
  height: 100%;
  display: block;
  left: 0;
  top: 0;
  content: "";
}

.page-header:before {
  background-color: rgba(0, 0, 0, 0.5);
}

.page-header[filter-color="orange"] {
  background: rgba(44, 44, 44, 0.2);
  /* For browsers that do not support gradients */
  /* For Safari 5.1 to 6.0 */
  /* For Opera 11.1 to 12.0 */
  /* For Firefox 3.6 to 15 */
  background: -webkit-gradient(linear, left bottom, left top, from(rgba(44, 44, 44, 0.2)), to(rgba(224, 23, 3, 0.6)));
  background: linear-gradient(0deg, rgba(44, 44, 44, 0.2), rgba(224, 23, 3, 0.6));
  /* Standard syntax */
}

.page-header .container {
  z-index: 2;
}

.clear-filter:after, .clear-filter:before {
  display: none;
}

.section-story-overview {
  padding: 50px 0;
}

.section-story-overview .image-container {
  height: 335px;
  position: relative;
  background-position: center center;
  background-size: cover;
  -webkit-box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.3);
          box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.3);
  border-radius: .25rem;
}

.section-story-overview .image-container + .category {
  padding-top: 15px;
}

.section-story-overview .image-container.image-right {
  z-index: 2;
}

.section-story-overview .image-container.image-right + h3.title {
  margin-top: 120px;
}

.section-story-overview .image-container.image-left {
  z-index: 1;
}

.section-story-overview .image-container:nth-child(2) {
  margin-top: 420px;
  margin-left: -105px;
}

.section-story-overview p.blockquote {
  width: 220px;
  min-height: 180px;
  text-align: left;
  position: absolute;
  top: 376px;
  right: 155px;
  z-index: 0;
}

.section-nucleo-icons .nucleo-container img {
  width: auto;
  left: 0;
  top: 0;
  height: 100%;
  position: absolute;
}

.section-nucleo-icons .nucleo-container {
  height: 335px;
  position: relative;
}

.section-nucleo-icons h5 {
  margin-bottom: 35px;
}

.section-nucleo-icons .icons-container {
  position: relative;
  max-width: 450px;
  height: 300px;
  max-height: 300px;
  margin: 0 auto;
}

.section-nucleo-icons .icons-container i {
  font-size: 34px;
  position: absolute;
  left: 0;
  top: 0;
}

.section-nucleo-icons .icons-container i:nth-child(1) {
  top: 5%;
  left: 7%;
}

.section-nucleo-icons .icons-container i:nth-child(2) {
  top: 28%;
  left: 24%;
}

.section-nucleo-icons .icons-container i:nth-child(3) {
  top: 40%;
}

.section-nucleo-icons .icons-container i:nth-child(4) {
  top: 18%;
  left: 62%;
}

.section-nucleo-icons .icons-container i:nth-child(5) {
  top: 74%;
  left: 3%;
}

.section-nucleo-icons .icons-container i:nth-child(6) {
  top: 36%;
  left: 44%;
  font-size: 65px;
  color: #f96332;
  padding: 1px;
}

.section-nucleo-icons .icons-container i:nth-child(7) {
  top: 59%;
  left: 26%;
}

.section-nucleo-icons .icons-container i:nth-child(8) {
  top: 60%;
  left: 69%;
}

.section-nucleo-icons .icons-container i:nth-child(9) {
  top: 72%;
  left: 47%;
}

.section-nucleo-icons .icons-container i:nth-child(10) {
  top: 88%;
  left: 27%;
}

.section-nucleo-icons .icons-container i:nth-child(11) {
  top: 31%;
  left: 80%;
}

.section-nucleo-icons .icons-container i:nth-child(12) {
  top: 88%;
  left: 68%;
}

.section-nucleo-icons .icons-container i:nth-child(13) {
  top: 5%;
  left: 81%;
}

.section-nucleo-icons .icons-container i:nth-child(14) {
  top: 58%;
  left: 90%;
}

.section-nucleo-icons .icons-container i:nth-child(15) {
  top: 6%;
  left: 40%;
}

.section-images {
  max-height: 670px;
  height: 670px;
}

.section-images .hero-images-container,
.section-images .hero-images-container-1,
.section-images .hero-images-container-2 {
  margin-top: -38vh;
}

.section-images .hero-images-container {
  max-width: 670px;
}

.section-images .hero-images-container-1 {
  max-width: 390px;
  position: absolute;
  top: 55%;
  right: 18%;
}

.section-images .hero-images-container-2 {
  max-width: 225px;
  position: absolute;
  top: 68%;
  right: 12%;
}

[data-background-color="orange"] {
  background-color: #e95e38;
}

[data-background-color="black"] {
  background-color: #2c2c2c;
}

[data-background-color] {
  color: #FFFFFF;
}

[data-background-color] .title,
[data-background-color] .social-description h2,
[data-background-color] p,
[data-background-color] p.blockquote,
[data-background-color] p.blockquote small,
[data-background-color] h1, [data-background-color] h2, [data-background-color] h3, [data-background-color] h4, [data-background-color] h5, [data-background-color] h6, [data-background-color] a:not(.btn):not(.dropdown-item),
[data-background-color] .icons-container i {
  color: #FFFFFF;
}

[data-background-color] .separator {
  background-color: #FFFFFF;
}

[data-background-color] .navbar.bg-white p {
  color: #888;
}

[data-background-color] .description,
[data-background-color] .social-description p {
  color: rgba(255, 255, 255, 0.8);
}

[data-background-color] p.blockquote {
  border-color: rgba(255, 255, 255, 0.2);
}

[data-background-color] .checkbox label::before,
[data-background-color] .checkbox label::after,
[data-background-color] .radio label::before,
[data-background-color] .radio label::after {
  border-color: rgba(255, 255, 255, 0.2);
}

[data-background-color] .checkbox label::after,
[data-background-color] .checkbox label,
[data-background-color] .radio label {
  color: #FFFFFF;
}

[data-background-color] .checkbox input[type="checkbox"]:disabled + label,
[data-background-color] .radio input[type="radio"]:disabled + label {
  color: #FFFFFF;
}

[data-background-color] .radio input[type="radio"]:not(:disabled):hover + label::after,
[data-background-color] .radio input[type="radio"]:checked + label::after {
  background-color: #FFFFFF;
  border-color: #FFFFFF;
}

[data-background-color] .form-control::-moz-placeholder {
  color: #ebebeb;
  opacity: 1;
  filter: alpha(opacity=100);
}

[data-background-color] .form-control:-moz-placeholder {
  color: #ebebeb;
  opacity: 1;
  filter: alpha(opacity=100);
}

[data-background-color] .form-control::-webkit-input-placeholder {
  color: #ebebeb;
  opacity: 1;
  filter: alpha(opacity=100);
}

[data-background-color] .form-control:-ms-input-placeholder {
  color: #ebebeb;
  opacity: 1;
  filter: alpha(opacity=100);
}

[data-background-color] .form-control {
  border-color: rgba(255, 255, 255, 0.5);
  color: #FFFFFF;
}

[data-background-color] .form-control:focus {
  border-color: #FFFFFF;
  background-color: transparent;
  color: #FFFFFF;
}

[data-background-color] .has-success:after,
[data-background-color] .has-danger:after {
  color: #FFFFFF;
}

[data-background-color] .has-danger .form-control {
  background-color: transparent;
}

[data-background-color] .input-group-addon {
  background-color: transparent;
  border-color: rgba(255, 255, 255, 0.5);
  color: #FFFFFF;
}

[data-background-color] .input-group-focus .input-group-addon {
  background-color: transparent;
  border-color: #FFFFFF;
  color: #FFFFFF;
}

[data-background-color] .form-group.form-group-no-border .form-control,
[data-background-color] .input-group.form-group-no-border .form-control {
  background-color: rgba(255, 255, 255, 0.1);
  color: #FFFFFF;
}

[data-background-color] .form-group.form-group-no-border .form-control:focus, [data-background-color] .form-group.form-group-no-border .form-control:active, [data-background-color] .form-group.form-group-no-border .form-control:active,
[data-background-color] .input-group.form-group-no-border .form-control:focus,
[data-background-color] .input-group.form-group-no-border .form-control:active,
[data-background-color] .input-group.form-group-no-border .form-control:active {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

[data-background-color] .form-group.form-group-no-border .form-control + .input-group-addon,
[data-background-color] .input-group.form-group-no-border .form-control + .input-group-addon {
  background-color: rgba(255, 255, 255, 0.1);
}

[data-background-color] .form-group.form-group-no-border .form-control + .input-group-addon:focus, [data-background-color] .form-group.form-group-no-border .form-control + .input-group-addon:active, [data-background-color] .form-group.form-group-no-border .form-control + .input-group-addon:active,
[data-background-color] .input-group.form-group-no-border .form-control + .input-group-addon:focus,
[data-background-color] .input-group.form-group-no-border .form-control + .input-group-addon:active,
[data-background-color] .input-group.form-group-no-border .form-control + .input-group-addon:active {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

[data-background-color] .form-group.form-group-no-border .form-control:focus + .input-group-addon,
[data-background-color] .input-group.form-group-no-border .form-control:focus + .input-group-addon {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

[data-background-color] .form-group.form-group-no-border .input-group-addon,
[data-background-color] .input-group.form-group-no-border .input-group-addon {
  background-color: rgba(255, 255, 255, 0.1);
  border: none;
  color: #FFFFFF;
}

[data-background-color] .form-group.form-group-no-border.input-group-focus .input-group-addon,
[data-background-color] .input-group.form-group-no-border.input-group-focus .input-group-addon {
  background-color: rgba(255, 255, 255, 0.2);
  color: #FFFFFF;
}

[data-background-color] .input-group-addon,
[data-background-color] .form-group.form-group-no-border .input-group-addon,
[data-background-color] .input-group.form-group-no-border .input-group-addon {
  color: rgba(255, 255, 255, 0.8);
}

[data-background-color] .btn.btn-simple {
  background-color: transparent;
  border-color: rgba(255, 255, 255, 0.5);
  color: #FFFFFF;
}

[data-background-color] .btn.btn-simple:hover, [data-background-color] .btn.btn-simple:hover, [data-background-color] .btn.btn-simple:focus, [data-background-color] .btn.btn-simple:active {
  background-color: transparent;
  border-color: #FFFFFF;
}

[data-background-color] .nav-tabs > .nav-item > .nav-link i.now-ui-icons {
  color: #FFFFFF;
}

[data-background-color].section-nucleo-icons .icons-container i:nth-child(6) {
  color: #FFFFFF;
}

@media screen and (max-width: 991px) {
  .sidebar-collapse .navbar-collapse {
    position: fixed;
    display: block;
    top: 0;
    height: 100% !important;
    width: 300px;
    right: 0;
    z-index: 1032;
    visibility: visible;
    background-color: #999;
    overflow-y: visible;
    border-top: none;
    text-align: left;
    max-height: none !important;
    -webkit-transform: translate3d(300px, 0, 0);
    transform: translate3d(300px, 0, 0);
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .sidebar-collapse .navbar-collapse:before {
    background: #378C3F;
    /* For browsers that do not support gradients */
    /* For Safari 5.1 to 6.0 */
    /* For Opera 11.1 to 12.0 */
    /* For Firefox 3.6 to 15 */
    background: -webkit-gradient(linear, left top, left bottom, from(#378C3F), color-stop(80%, #000));
    background: linear-gradient(#378C3F 0%, #000 80%);
    /* Standard syntax (must be last) */
    opacity: 0.76;
    filter: alpha(opacity=76);
    display: block;
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;
  }
  .sidebar-collapse .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link {
    margin: 0 1rem;
    margin-top: 0.3125rem;
  }
  .sidebar-collapse .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link:not(.btn) {
    color: #FFFFFF;
  }
  .sidebar-collapse .navbar-collapse .dropdown-menu .dropdown-item {
    color: #FFFFFF;
  }
  .sidebar-collapse .navbar .navbar-nav {
    margin-top: 53px;
  }
  .sidebar-collapse .navbar .navbar-nav .nav-link {
    padding-top: 0.75rem;
    padding-bottom: .75rem;
  }
  .sidebar-collapse .navbar .navbar-nav.navbar-logo {
    top: 0;
    height: 53px;
  }
  .sidebar-collapse .navbar .dropdown.show .dropdown-menu,
  .sidebar-collapse .navbar .dropdown .dropdown-menu {
    background-color: transparent;
    border: 0;
    -webkit-transition: none;
    transition: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    width: auto;
    margin: 0 1rem;
    margin-bottom: 15px;
    padding-top: 0;
    height: 150px;
    overflow-y: scroll;
  }
  .sidebar-collapse .navbar .dropdown.show .dropdown-menu:before,
  .sidebar-collapse .navbar .dropdown .dropdown-menu:before {
    display: none;
  }
  .sidebar-collapse .navbar .dropdown .dropdown-item {
    padding-left: 2.5rem;
  }
  .sidebar-collapse .navbar .dropdown .dropdown-menu {
    display: none;
  }
  .sidebar-collapse .navbar .dropdown.show .dropdown-menu {
    display: block;
  }
  .sidebar-collapse .navbar .dropdown-menu .dropdown-item:focus,
  .sidebar-collapse .navbar .dropdown-menu .dropdown-item:hover {
    color: #FFFFFF;
  }
  .sidebar-collapse .navbar .navbar-translate {
    width: 100%;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify !important;
    -webkit-box-pack: justify !important;
            justify-content: space-between !important;
    -ms-flex-align: center;
    -webkit-box-align: center;
            align-items: center;
    -webkit-transform: translate3d(0px, 0, 0);
    transform: translate3d(0px, 0, 0);
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .sidebar-collapse .navbar .navbar-toggler-bar {
    display: block;
    position: relative;
    width: 22px;
    height: 1px;
    border-radius: 1px;
    background: #FFFFFF;
  }
  .sidebar-collapse .navbar .navbar-toggler-bar + .navbar-toggler-bar {
    margin-top: 7px;
  }
  .sidebar-collapse .navbar .navbar-toggler-bar.bar2 {
    width: 17px;
    -webkit-transition: width .2s linear;
    transition: width .2s linear;
  }
  .sidebar-collapse .navbar.bg-white:not(.navbar-transparent) .navbar-toggler-bar {
    background: #888;
  }
  .sidebar-collapse .navbar .toggled .navbar-toggler-bar {
    width: 24px;
  }
  .sidebar-collapse .navbar .toggled .navbar-toggler-bar + .navbar-toggler-bar {
    margin-top: 5px;
  }
  .sidebar-collapse .bar1,
  .sidebar-collapse .bar2,
  .sidebar-collapse .bar3 {
    outline: 1px solid transparent;
  }
  .sidebar-collapse .bar1 {
    top: 0px;
    -webkit-animation: topbar-back 500ms linear 0s;
    animation: topbar-back 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .sidebar-collapse .bar2 {
    opacity: 1;
  }
  .sidebar-collapse .bar3 {
    bottom: 0px;
    -webkit-animation: bottombar-back 500ms linear 0s;
    animation: bottombar-back 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .sidebar-collapse .toggled .bar1 {
    top: 6px;
    -webkit-animation: topbar-x 500ms linear 0s;
    animation: topbar-x 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .sidebar-collapse .toggled .bar2 {
    opacity: 0;
  }
  .sidebar-collapse .toggled .bar3 {
    bottom: 6px;
    -webkit-animation: bottombar-x 500ms linear 0s;
    animation: bottombar-x 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  @keyframes topbar-x {
    0% {
      top: 0px;
      -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
    }
    45% {
      top: 6px;
      -webkit-transform: rotate(145deg);
              transform: rotate(145deg);
    }
    75% {
      -webkit-transform: rotate(130deg);
              transform: rotate(130deg);
    }
    100% {
      -webkit-transform: rotate(135deg);
              transform: rotate(135deg);
    }
  }
  @-webkit-keyframes topbar-x {
    0% {
      top: 0px;
      -webkit-transform: rotate(0deg);
    }
    45% {
      top: 6px;
      -webkit-transform: rotate(145deg);
    }
    75% {
      -webkit-transform: rotate(130deg);
    }
    100% {
      -webkit-transform: rotate(135deg);
    }
  }
  @keyframes topbar-back {
    0% {
      top: 6px;
      -webkit-transform: rotate(135deg);
              transform: rotate(135deg);
    }
    45% {
      -webkit-transform: rotate(-10deg);
              transform: rotate(-10deg);
    }
    75% {
      -webkit-transform: rotate(5deg);
              transform: rotate(5deg);
    }
    100% {
      top: 0px;
      -webkit-transform: rotate(0);
              transform: rotate(0);
    }
  }
  @-webkit-keyframes topbar-back {
    0% {
      top: 6px;
      -webkit-transform: rotate(135deg);
    }
    45% {
      -webkit-transform: rotate(-10deg);
    }
    75% {
      -webkit-transform: rotate(5deg);
    }
    100% {
      top: 0px;
      -webkit-transform: rotate(0);
    }
  }
  @keyframes bottombar-x {
    0% {
      bottom: 0px;
      -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
    }
    45% {
      bottom: 6px;
      -webkit-transform: rotate(-145deg);
              transform: rotate(-145deg);
    }
    75% {
      -webkit-transform: rotate(-130deg);
              transform: rotate(-130deg);
    }
    100% {
      -webkit-transform: rotate(-135deg);
              transform: rotate(-135deg);
    }
  }
  @-webkit-keyframes bottombar-x {
    0% {
      bottom: 0px;
      -webkit-transform: rotate(0deg);
    }
    45% {
      bottom: 6px;
      -webkit-transform: rotate(-145deg);
    }
    75% {
      -webkit-transform: rotate(-130deg);
    }
    100% {
      -webkit-transform: rotate(-135deg);
    }
  }
  @keyframes bottombar-back {
    0% {
      bottom: 6px;
      -webkit-transform: rotate(-135deg);
              transform: rotate(-135deg);
    }
    45% {
      -webkit-transform: rotate(10deg);
              transform: rotate(10deg);
    }
    75% {
      -webkit-transform: rotate(-5deg);
              transform: rotate(-5deg);
    }
    100% {
      bottom: 0px;
      -webkit-transform: rotate(0);
              transform: rotate(0);
    }
  }
  @-webkit-keyframes bottombar-back {
    0% {
      bottom: 6px;
      -webkit-transform: rotate(-135deg);
    }
    45% {
      -webkit-transform: rotate(10deg);
    }
    75% {
      -webkit-transform: rotate(-5deg);
    }
    100% {
      bottom: 0px;
      -webkit-transform: rotate(0);
    }
  }
  @-webkit-keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  .sidebar-collapse [class*="navbar-expand-"] .navbar-collapse {
    width: 300px;
  }
  .sidebar-collapse .wrapper {
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .sidebar-collapse #bodyClick {
    height: 100%;
    width: 100%;
    position: fixed;
    opacity: 1;
    top: 0;
    left: auto;
    right: 300px;
    content: "";
    z-index: 9999;
    overflow-x: hidden;
    background-color: transparent;
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .sidebar-collapse.menu-on-left .navbar-collapse {
    right: auto;
    left: 0;
    -webkit-transform: translate3d(-300px, 0, 0);
    transform: translate3d(-300px, 0, 0);
  }
  .nav-open .sidebar-collapse .navbar-collapse {
    -webkit-transform: translate3d(0px, 0, 0);
    transform: translate3d(0px, 0, 0);
  }
  .nav-open .sidebar-collapse .wrapper {
    -webkit-transform: translate3d(-150px, 0, 0);
    transform: translate3d(-150px, 0, 0);
  }
  .nav-open .sidebar-collapse .navbar-translate {
    -webkit-transform: translate3d(-300px, 0, 0);
    transform: translate3d(-300px, 0, 0);
  }
  .nav-open .sidebar-collapse.menu-on-left .navbar-collapse {
    -webkit-transform: translate3d(0px, 0, 0);
    transform: translate3d(0px, 0, 0);
  }
  .nav-open .sidebar-collapse.menu-on-left .navbar-translate {
    -webkit-transform: translate3d(300px, 0, 0);
    transform: translate3d(300px, 0, 0);
  }
  .nav-open .sidebar-collapse.menu-on-left .wrapper {
    -webkit-transform: translate3d(150px, 0, 0);
    transform: translate3d(150px, 0, 0);
  }
  .nav-open .sidebar-collapse.menu-on-left #bodyClick {
    right: auto;
    left: 300px;
  }
  .bootstrap-collapse .navbar .navbar-collapse {
    background: none !important;
  }
  .bootstrap-collapse .navbar .navbar-nav {
    margin-top: 53px;
  }
  .bootstrap-collapse .navbar .navbar-nav .nav-link {
    padding-top: 0.75rem;
    padding-bottom: .75rem;
  }
  .bootstrap-collapse .navbar .navbar-nav.navbar-logo {
    top: 0;
    height: 53px;
  }
  .bootstrap-collapse .navbar .dropdown.show .dropdown-menu,
  .bootstrap-collapse .navbar .dropdown .dropdown-menu {
    background-color: transparent;
    border: 0;
    -webkit-transition: none;
    transition: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    width: auto;
    margin: 0 1rem;
    margin-bottom: 15px;
    padding-top: 0;
    height: 150px;
    overflow-y: scroll;
  }
  .bootstrap-collapse .navbar .dropdown.show .dropdown-menu:before,
  .bootstrap-collapse .navbar .dropdown .dropdown-menu:before {
    display: none;
  }
  .bootstrap-collapse .navbar .dropdown .dropdown-item {
    padding-left: 2.5rem;
  }
  .bootstrap-collapse .navbar .dropdown .dropdown-menu {
    display: none;
  }
  .bootstrap-collapse .navbar .dropdown.show .dropdown-menu {
    display: block;
  }
  .bootstrap-collapse .navbar .dropdown-menu .dropdown-item:focus,
  .bootstrap-collapse .navbar .dropdown-menu .dropdown-item:hover {
    color: #FFFFFF;
  }
  .bootstrap-collapse .navbar .navbar-translate {
    width: 100%;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify !important;
    -webkit-box-pack: justify !important;
            justify-content: space-between !important;
    -ms-flex-align: center;
    -webkit-box-align: center;
            align-items: center;
    -webkit-transform: translate3d(0px, 0, 0);
    transform: translate3d(0px, 0, 0);
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .bootstrap-collapse .navbar .navbar-toggler-bar {
    display: block;
    position: relative;
    width: 22px;
    height: 1px;
    border-radius: 1px;
    background: #FFFFFF;
  }
  .bootstrap-collapse .navbar .navbar-toggler-bar + .navbar-toggler-bar {
    margin-top: 7px;
  }
  .bootstrap-collapse .navbar .navbar-toggler-bar.bar2 {
    width: 17px;
    -webkit-transition: width .2s linear;
    transition: width .2s linear;
  }
  .bootstrap-collapse .navbar.bg-white:not(.navbar-transparent) .navbar-toggler-bar {
    background: #888;
  }
  .bootstrap-collapse .navbar .toggled .navbar-toggler-bar {
    width: 24px;
  }
  .bootstrap-collapse .navbar .toggled .navbar-toggler-bar + .navbar-toggler-bar {
    margin-top: 5px;
  }
  .bootstrap-collapse .bar1,
  .bootstrap-collapse .bar2,
  .bootstrap-collapse .bar3 {
    outline: 1px solid transparent;
  }
  .bootstrap-collapse .bar1 {
    top: 0px;
    -webkit-animation: topbar-back 500ms linear 0s;
    animation: topbar-back 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .bootstrap-collapse .bar2 {
    opacity: 1;
  }
  .bootstrap-collapse .bar3 {
    bottom: 0px;
    -webkit-animation: bottombar-back 500ms linear 0s;
    animation: bottombar-back 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .bootstrap-collapse .toggled .bar1 {
    top: 6px;
    -webkit-animation: topbar-x 500ms linear 0s;
    animation: topbar-x 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .bootstrap-collapse .toggled .bar2 {
    opacity: 0;
  }
  .bootstrap-collapse .toggled .bar3 {
    bottom: 6px;
    -webkit-animation: bottombar-x 500ms linear 0s;
    animation: bottombar-x 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  @keyframes topbar-x {
    0% {
      top: 0px;
      -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
    }
    45% {
      top: 6px;
      -webkit-transform: rotate(145deg);
              transform: rotate(145deg);
    }
    75% {
      -webkit-transform: rotate(130deg);
              transform: rotate(130deg);
    }
    100% {
      -webkit-transform: rotate(135deg);
              transform: rotate(135deg);
    }
  }
  @-webkit-keyframes topbar-x {
    0% {
      top: 0px;
      -webkit-transform: rotate(0deg);
    }
    45% {
      top: 6px;
      -webkit-transform: rotate(145deg);
    }
    75% {
      -webkit-transform: rotate(130deg);
    }
    100% {
      -webkit-transform: rotate(135deg);
    }
  }
  @keyframes topbar-back {
    0% {
      top: 6px;
      -webkit-transform: rotate(135deg);
              transform: rotate(135deg);
    }
    45% {
      -webkit-transform: rotate(-10deg);
              transform: rotate(-10deg);
    }
    75% {
      -webkit-transform: rotate(5deg);
              transform: rotate(5deg);
    }
    100% {
      top: 0px;
      -webkit-transform: rotate(0);
              transform: rotate(0);
    }
  }
  @-webkit-keyframes topbar-back {
    0% {
      top: 6px;
      -webkit-transform: rotate(135deg);
    }
    45% {
      -webkit-transform: rotate(-10deg);
    }
    75% {
      -webkit-transform: rotate(5deg);
    }
    100% {
      top: 0px;
      -webkit-transform: rotate(0);
    }
  }
  @keyframes bottombar-x {
    0% {
      bottom: 0px;
      -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
    }
    45% {
      bottom: 6px;
      -webkit-transform: rotate(-145deg);
              transform: rotate(-145deg);
    }
    75% {
      -webkit-transform: rotate(-130deg);
              transform: rotate(-130deg);
    }
    100% {
      -webkit-transform: rotate(-135deg);
              transform: rotate(-135deg);
    }
  }
  @-webkit-keyframes bottombar-x {
    0% {
      bottom: 0px;
      -webkit-transform: rotate(0deg);
    }
    45% {
      bottom: 6px;
      -webkit-transform: rotate(-145deg);
    }
    75% {
      -webkit-transform: rotate(-130deg);
    }
    100% {
      -webkit-transform: rotate(-135deg);
    }
  }
  @keyframes bottombar-back {
    0% {
      bottom: 6px;
      -webkit-transform: rotate(-135deg);
              transform: rotate(-135deg);
    }
    45% {
      -webkit-transform: rotate(10deg);
              transform: rotate(10deg);
    }
    75% {
      -webkit-transform: rotate(-5deg);
              transform: rotate(-5deg);
    }
    100% {
      bottom: 0px;
      -webkit-transform: rotate(0);
              transform: rotate(0);
    }
  }
  @-webkit-keyframes bottombar-back {
    0% {
      bottom: 6px;
      -webkit-transform: rotate(-135deg);
    }
    45% {
      -webkit-transform: rotate(10deg);
    }
    75% {
      -webkit-transform: rotate(-5deg);
    }
    100% {
      bottom: 0px;
      -webkit-transform: rotate(0);
    }
  }
  @-webkit-keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  .profile-photo .profile-photo-small {
    margin-left: -2px;
  }
  .button-dropdown {
    display: none;
  }
  .section-nucleo-icons .container .row > [class*="col-"]:first-child {
    text-align: center;
  }
  .footer .copyright {
    text-align: right;
  }
  .section-nucleo-icons .icons-container {
    margin-top: 65px;
  }
  .navbar-nav .nav-link i.fa,
  .navbar-nav .nav-link i.now-ui-icons {
    opacity: .5;
  }
  .section-images {
    height: 500px;
    max-height: 500px;
  }
  .section-images .hero-images-container {
    max-width: 500px;
  }
  .section-images .hero-images-container-1 {
    right: 10%;
    top: 68%;
    max-width: 269px;
  }
  .section-images .hero-images-container-2 {
    right: 5%;
    max-width: 135px;
    top: 93%;
  }
}

@media screen and (min-width: 992px) {
  .burger-menu .navbar-collapse {
    position: fixed;
    display: block;
    top: 0;
    height: 100% !important;
    width: 300px;
    right: 0;
    z-index: 1032;
    visibility: visible;
    background-color: #999;
    overflow-y: visible;
    border-top: none;
    text-align: left;
    max-height: none !important;
    -webkit-transform: translate3d(300px, 0, 0);
    transform: translate3d(300px, 0, 0);
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .burger-menu .navbar-collapse:before {
    background: #378C3F;
    /* For browsers that do not support gradients */
    /* For Safari 5.1 to 6.0 */
    /* For Opera 11.1 to 12.0 */
    /* For Firefox 3.6 to 15 */
    background: -webkit-gradient(linear, left top, left bottom, from(#378C3F), color-stop(80%, #000));
    background: linear-gradient(#378C3F 0%, #000 80%);
    /* Standard syntax (must be last) */
    opacity: 0.76;
    filter: alpha(opacity=76);
    display: block;
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: -1;
  }
  .burger-menu .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link {
    margin: 0 1rem;
    margin-top: 0.3125rem;
  }
  .burger-menu .navbar-collapse .navbar-nav:not(.navbar-logo) .nav-link:not(.btn) {
    color: #FFFFFF;
  }
  .burger-menu .navbar-collapse .dropdown-menu .dropdown-item {
    color: #FFFFFF;
  }
  .burger-menu .navbar .navbar-nav {
    margin-top: 53px;
  }
  .burger-menu .navbar .navbar-nav .nav-link {
    padding-top: 0.75rem;
    padding-bottom: .75rem;
  }
  .burger-menu .navbar .navbar-nav.navbar-logo {
    top: 0;
    height: 53px;
  }
  .burger-menu .navbar .dropdown.show .dropdown-menu,
  .burger-menu .navbar .dropdown .dropdown-menu {
    background-color: transparent;
    border: 0;
    -webkit-transition: none;
    transition: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    width: auto;
    margin: 0 1rem;
    margin-bottom: 15px;
    padding-top: 0;
    height: 150px;
    overflow-y: scroll;
  }
  .burger-menu .navbar .dropdown.show .dropdown-menu:before,
  .burger-menu .navbar .dropdown .dropdown-menu:before {
    display: none;
  }
  .burger-menu .navbar .dropdown .dropdown-item {
    padding-left: 2.5rem;
  }
  .burger-menu .navbar .dropdown .dropdown-menu {
    display: none;
  }
  .burger-menu .navbar .dropdown.show .dropdown-menu {
    display: block;
  }
  .burger-menu .navbar .dropdown-menu .dropdown-item:focus,
  .burger-menu .navbar .dropdown-menu .dropdown-item:hover {
    color: #FFFFFF;
  }
  .burger-menu .navbar .navbar-translate {
    width: 100%;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify !important;
    -webkit-box-pack: justify !important;
            justify-content: space-between !important;
    -ms-flex-align: center;
    -webkit-box-align: center;
            align-items: center;
    -webkit-transform: translate3d(0px, 0, 0);
    transform: translate3d(0px, 0, 0);
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .burger-menu .navbar .navbar-toggler-bar {
    display: block;
    position: relative;
    width: 22px;
    height: 1px;
    border-radius: 1px;
    background: #FFFFFF;
  }
  .burger-menu .navbar .navbar-toggler-bar + .navbar-toggler-bar {
    margin-top: 7px;
  }
  .burger-menu .navbar .navbar-toggler-bar.bar2 {
    width: 17px;
    -webkit-transition: width .2s linear;
    transition: width .2s linear;
  }
  .burger-menu .navbar.bg-white:not(.navbar-transparent) .navbar-toggler-bar {
    background: #888;
  }
  .burger-menu .navbar .toggled .navbar-toggler-bar {
    width: 24px;
  }
  .burger-menu .navbar .toggled .navbar-toggler-bar + .navbar-toggler-bar {
    margin-top: 5px;
  }
  .burger-menu .bar1,
  .burger-menu .bar2,
  .burger-menu .bar3 {
    outline: 1px solid transparent;
  }
  .burger-menu .bar1 {
    top: 0px;
    -webkit-animation: topbar-back 500ms linear 0s;
    animation: topbar-back 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .burger-menu .bar2 {
    opacity: 1;
  }
  .burger-menu .bar3 {
    bottom: 0px;
    -webkit-animation: bottombar-back 500ms linear 0s;
    animation: bottombar-back 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .burger-menu .toggled .bar1 {
    top: 6px;
    -webkit-animation: topbar-x 500ms linear 0s;
    animation: topbar-x 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  .burger-menu .toggled .bar2 {
    opacity: 0;
  }
  .burger-menu .toggled .bar3 {
    bottom: 6px;
    -webkit-animation: bottombar-x 500ms linear 0s;
    animation: bottombar-x 500ms 0s;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  }
  @keyframes topbar-x {
    0% {
      top: 0px;
      -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
    }
    45% {
      top: 6px;
      -webkit-transform: rotate(145deg);
              transform: rotate(145deg);
    }
    75% {
      -webkit-transform: rotate(130deg);
              transform: rotate(130deg);
    }
    100% {
      -webkit-transform: rotate(135deg);
              transform: rotate(135deg);
    }
  }
  @-webkit-keyframes topbar-x {
    0% {
      top: 0px;
      -webkit-transform: rotate(0deg);
    }
    45% {
      top: 6px;
      -webkit-transform: rotate(145deg);
    }
    75% {
      -webkit-transform: rotate(130deg);
    }
    100% {
      -webkit-transform: rotate(135deg);
    }
  }
  @keyframes topbar-back {
    0% {
      top: 6px;
      -webkit-transform: rotate(135deg);
              transform: rotate(135deg);
    }
    45% {
      -webkit-transform: rotate(-10deg);
              transform: rotate(-10deg);
    }
    75% {
      -webkit-transform: rotate(5deg);
              transform: rotate(5deg);
    }
    100% {
      top: 0px;
      -webkit-transform: rotate(0);
              transform: rotate(0);
    }
  }
  @-webkit-keyframes topbar-back {
    0% {
      top: 6px;
      -webkit-transform: rotate(135deg);
    }
    45% {
      -webkit-transform: rotate(-10deg);
    }
    75% {
      -webkit-transform: rotate(5deg);
    }
    100% {
      top: 0px;
      -webkit-transform: rotate(0);
    }
  }
  @keyframes bottombar-x {
    0% {
      bottom: 0px;
      -webkit-transform: rotate(0deg);
              transform: rotate(0deg);
    }
    45% {
      bottom: 6px;
      -webkit-transform: rotate(-145deg);
              transform: rotate(-145deg);
    }
    75% {
      -webkit-transform: rotate(-130deg);
              transform: rotate(-130deg);
    }
    100% {
      -webkit-transform: rotate(-135deg);
              transform: rotate(-135deg);
    }
  }
  @-webkit-keyframes bottombar-x {
    0% {
      bottom: 0px;
      -webkit-transform: rotate(0deg);
    }
    45% {
      bottom: 6px;
      -webkit-transform: rotate(-145deg);
    }
    75% {
      -webkit-transform: rotate(-130deg);
    }
    100% {
      -webkit-transform: rotate(-135deg);
    }
  }
  @keyframes bottombar-back {
    0% {
      bottom: 6px;
      -webkit-transform: rotate(-135deg);
              transform: rotate(-135deg);
    }
    45% {
      -webkit-transform: rotate(10deg);
              transform: rotate(10deg);
    }
    75% {
      -webkit-transform: rotate(-5deg);
              transform: rotate(-5deg);
    }
    100% {
      bottom: 0px;
      -webkit-transform: rotate(0);
              transform: rotate(0);
    }
  }
  @-webkit-keyframes bottombar-back {
    0% {
      bottom: 6px;
      -webkit-transform: rotate(-135deg);
    }
    45% {
      -webkit-transform: rotate(10deg);
    }
    75% {
      -webkit-transform: rotate(-5deg);
    }
    100% {
      bottom: 0px;
      -webkit-transform: rotate(0);
    }
  }
  @-webkit-keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  .burger-menu [class*="navbar-expand-"] .navbar-collapse {
    width: 300px;
  }
  .burger-menu .wrapper {
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .burger-menu #bodyClick {
    height: 100%;
    width: 100%;
    position: fixed;
    opacity: 1;
    top: 0;
    left: auto;
    right: 300px;
    content: "";
    z-index: 9999;
    overflow-x: hidden;
    background-color: transparent;
    -webkit-transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
  }
  .nav-open .burger-menu .navbar-collapse {
    -webkit-transform: translate3d(0px, 0, 0);
    transform: translate3d(0px, 0, 0);
  }
  .burger-menu .navbar-collapse {
    display: block !important;
  }
  .burger-menu .navbar-collapse .navbar-nav {
    margin-top: 53px;
    height: 100%;
    z-index: 2;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
  }
  .burger-menu .navbar-collapse .navbar-nav .nav-item {
    margin: 0;
  }
  .burger-menu.menu-on-left .navbar-collapse {
    right: auto;
    left: 0;
    -webkit-transform: translate3d(-300px, 0, 0);
    transform: translate3d(-300px, 0, 0);
  }
  .burger-menu [class*="navbar-expand-"] .navbar-nav .dropdown-menu {
    position: static;
    float: none;
  }
  .burger-menu [class*="navbar-expand-"] .navbar-toggler {
    display: inline-block;
  }
  .burger-menu .section-navbars .navbar-collapse {
    display: none !important;
  }
  .nav-open .burger-menu.menu-on-left .navbar .navbar-translate {
    -webkit-transform: translate3d(300px, 0, 0);
    transform: translate3d(300px, 0, 0);
  }
  .nav-open .burger-menu .navbar .navbar-translate {
    -webkit-transform: translate3d(-300px, 0, 0);
    transform: translate3d(-300px, 0, 0);
  }
  .nav-open .burger-menu.menu-on-left .navbar-collapse {
    -webkit-transform: translate3d(0px, 0, 0);
    transform: translate3d(0px, 0, 0);
  }
  .nav-open .burger-menu.menu-on-left #bodyClick {
    right: auto;
    left: 300px;
  }
  .burger-menu.menu-on-left .navbar-brand {
    float: right;
    margin-right: 0;
    margin-left: 1rem;
  }
  .navbar-nav .nav-link.profile-photo {
    padding: 0;
    margin: 7px 0.7rem;
  }
  .navbar-nav .nav-link.btn:not(.btn-sm) {
    margin: 0;
  }
  .navbar-nav .nav-item:not(:last-child) {
    margin-right: 5px;
  }
  .section-nucleo-icons .icons-container {
    margin: 0 0 0 auto;
  }
  .dropdown-menu .dropdown-item {
    color: inherit;
  }
  .footer .copyright {
    float: right;
  }
}

@media screen and (min-width: 768px) {
  .image-container.image-right {
    top: 80px;
    margin-left: -100px;
    margin-bottom: 130px;
  }
  .image-container.image-left {
    margin-right: -100px;
  }
}

@media screen and (max-width: 768px) {
  .image-container.image-left {
    margin-bottom: 220px;
  }
  .image-container.image-left p.blockquote {
    margin: 0 auto;
    position: relative;
    right: 0;
  }
  .nav-tabs {
    display: inline-block;
    width: 100%;
    padding-left: 100px;
    padding-right: 100px;
    text-align: center;
  }
  .nav-tabs .nav-item > .nav-link {
    margin-bottom: 5px;
  }
  .landing-page .section-story-overview .image-container:nth-child(2) {
    margin-left: 0;
    margin-bottom: 30px;
  }
}

@media screen and (max-width: 576px) {
  .navbar[class*='navbar-expand-'] .container {
    margin-left: 0;
    margin-right: 0;
  }
  .footer .copyright {
    text-align: center;
  }
  .section-nucleo-icons .icons-container i {
    font-size: 30px;
  }
  .section-nucleo-icons .icons-container i:nth-child(6) {
    font-size: 48px;
  }
  .page-header .container h6.category-absolute {
    width: 90%;
  }
}

@media screen and (min-width: 991px) and (max-width: 1200px) {
  .section-images .hero-images-container-1 {
    right: 9%;
    max-width: 370px;
  }
  .section-images .hero-images-container-2 {
    right: 2%;
    max-width: 216px;
  }
}

@media screen and (max-width: 768px) {
  .section-images {
    height: 300px;
    max-height: 300px;
  }
  .section-images .hero-images-container {
    max-width: 380px;
  }
  .section-images .hero-images-container-1 {
    right: 7%;
    top: 87%;
    max-width: 210px;
  }
  .section-images .hero-images-container-2 {
    right: 1%;
    max-width: 133px;
    top: 99%;
  }
}

@media screen and (max-width: 517px) {
  .alert .alert-icon {
    margin-top: 10px;
  }
}

@media screen and (min-width: 1200px) {
  .section-images .hero-images-container-1 {
    top: 51%;
    right: 21%;
  }
  .section-images .hero-images-container-2 {
    top: 66%;
    right: 14%;
  }
}

@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: portrait) {
  .section-images .hero-images-container,
  .section-images .hero-images-container-1,
  .section-images .hero-images-container-2 {
    margin-top: -15vh;
    margin-left: 80px;
  }
  .section-images .hero-images-container {
    max-width: 300px;
  }
  .section-images .hero-images-container-1 {
    right: 28%;
    top: 40%;
  }
  .section-images .hero-images-container-2 {
    right: 21%;
    top: 55%;
  }
  .index-page .category-absolute {
    top: 90vh;
  }
}

@media screen and (max-width: 580px) {
  .alert button.close {
    position: absolute;
    right: 11px;
    top: 50%;
    -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
  }
}

/* Images Gallery Style*/
.gallery .cc-porfolio-image figure {
  position: relative;
  overflow: hidden;
  text-align: center;
}

.gallery .cc-porfolio-image figure img {
  position: relative;
  display: block;
  max-width: 100%;
  opacity: 1;
}

.gallery .cc-porfolio-image figure figcaption {
  position: absolute;
  color: #fff;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}

.gallery .cc-porfolio-image figure figcaption,
.gallery .cc-porfolio-image figure figcaption > a {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.gallery .cc-porfolio-image figure figcaption > a {
  z-index: 1000;
  text-indent: 200%;
  white-space: nowrap;
  font-size: 0;
  opacity: 0;
}

.gallery .cc-porfolio-image figure .h4,
.gallery .cc-porfolio-image figure p {
  margin: 0;
}

.gallery figure.cc-effect figcaption::before,
.gallery figure.cc-effect figcaption::after {
  position: absolute;
  content: '';
  opacity: 0;
}

.gallery figure.cc-effect figcaption::before {
  top: 10px;
  right: 10px;
  bottom: 10px;
  left: 10px;
  -webkit-transform: scale(0, 0);
  transform: scale(0, 0);
  -webkit-transform-origin: 0 0;
  transform-origin: 0 0;
}

.gallery figure.cc-effect figcaption::after {
  top: 10px;
  right: 10px;
  bottom: 10px;
  left: 10px;
  -webkit-transform: scale(0, 0);
  transform: scale(0, 0);
  -webkit-transform-origin: 100% 0;
  transform-origin: 100% 0;
}

.gallery figure.cc-effect .h4 {
  margin-top: 25%;
  -webkit-transition: -webkit-transform 0.35s;
  transition: -webkit-transform 0.35s;
  transition: transform 0.35s;
  transition: transform 0.35s, -webkit-transform 0.35s;
  opacity: 0;
}

@media (max-width: 480px) {
  .gallery figure.cc-effect .h4 {
    font-size: 14px;
  }
}

.gallery figcaption .container {
  position: absolute;
  width: 100%;
  bottom: 20px;
}

.gallery figure.cc-effect p,
.gallery figure.cc-effect button {
  padding: 0.5em 2em;
  text-transform: uppercase;
  letter-spacing: 1px;
  -webkit-transition: -webkit-transform 0.35s;
  transition: -webkit-transform 0.35s;
  transition: transform 0.35s;
  transition: transform 0.35s, -webkit-transform 0.35s;
  opacity: 0;
}

.gallery figure.cc-effect img,
.gallery figure.cc-effect .h4 {
  -webkit-transform: scale(1.06, 1.06);
  transform: scale(1.06, 1.06);
}

.gallery figure.cc-effect img,
.gallery figure.cc-effect figcaption::before,
.gallery figure.cc-effect figcaption::after,
.gallery figure.cc-effect p {
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, transform 0.35s;
  transition: opacity 0.35s, transform 0.35s, -webkit-transform 0.35s;
}

.gallery figure.cc-effect:hover img {
  opacity: 1;
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}

.gallery figure.cc-effect:hover figcaption::before,
.gallery figure.cc-effect:hover figcaption::after {
  opacity: 1;
  -webkit-transform: scale(1);
  transform: scale(1);
}

.gallery figure.cc-effect:hover figcaption:before {
  background: rgba(27, 23, 23, 0.5);
}

.gallery figure.cc-effect:hover .h4,
.gallery figure.cc-effect:hover p,
.gallery figure.cc-effect:hover button {
  opacity: 1;
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  color: #fff;
}

.gallery figure.cc-effect:hover figcaption::after,
.gallery figure.cc-effect:hover .h4,
.gallery figure.cc-effect:hover p,
.gallery figure.cc-effect:hover img {
  -webkit-transition-delay: 0.15s;
  transition-delay: 0.15s;
}

/* Header */
/* Navbar style*/
.navbar {
  font-size: 18px;
  letter-spacing: 1px;
}

/* Body */
/* Profile Page Background Style */
.page-header {
  background: rgba(44, 44, 44, 0.2);
  /* For browsers that do not support gradients */
  /* For Safari 5.1 to 6.0 */
  /* For Opera 11.1 to 12.0 */
  /* For Firefox 3.6 to 15 */
  background: -webkit-gradient(linear, left bottom, left top, from(rgba(44, 44, 44, 0.2)), to(rgba(55, 140, 63, 0.6)));
  background: linear-gradient(0deg, rgba(44, 44, 44, 0.2), rgba(55, 140, 63, 0.6));
  /* Standard syntax */
}

.page-header .btn {
  width: 140px;
}

/* Profile Image Style */
@-webkit-keyframes pulsate {
  0% {
    -webkit-transform: scale(0.6, 0.6);
            transform: scale(0.6, 0.6);
    opacity: 0.0;
  }
  50% {
    opacity: 1.0;
  }
  100% {
    -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
    opacity: 0.0;
  }
}
@keyframes pulsate {
  0% {
    -webkit-transform: scale(0.6, 0.6);
            transform: scale(0.6, 0.6);
    opacity: 0.0;
  }
  50% {
    opacity: 1.0;
  }
  100% {
    -webkit-transform: scale(1, 1);
            transform: scale(1, 1);
    opacity: 0.0;
  }
}

.cc-profile-image a {
  position: relative;
}

.cc-profile-image a:before {
  content: "";
  border: 15px solid rgba(55, 140, 63, 0.6);
  border-radius: 50%;
  height: 180px;
  width: 180px;
  position: absolute;
  left: 0;
  -webkit-animation: pulsate 1.6s ease-out;
          animation: pulsate 1.6s ease-out;
  -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
  opacity: 0.0;
  z-index: 99;
}

.cc-profile-image img {
  position: relative;
  border-radius: 50%;
  height: 180px;
  width: 180px;
  padding: 0;
  margin: 0;
  border: 15px solid transparent;
  z-index: 9999;
  -webkit-transition: all .3s ease-out;
  transition: all .3s ease-out;
}

.cc-profile-image a:hover img {
  -webkit-transform: scale(1.06, 1.06);
          transform: scale(1.06, 1.06);
}

.cc-profile-image a:hover:before {
  -webkit-animation: none;
          animation: none;
}

/* Profile Page Social button Style */
.button-container .btn-default {
  margin-right: 8px;
}

/* Professional Skills Style */
.progress-container {
  margin-bottom: 20px;
  font-size: 18px;
}

.progress-container .progress-bar {
  height: 5px;
  -webkit-transform: scaleX(0);
          transform: scaleX(0);
  -webkit-transition: -webkit-transform 2s ease-in-out;
  transition: -webkit-transform 2s ease-in-out;
  transition: transform 2s ease-in-out;
  transition: transform 2s ease-in-out, -webkit-transform 2s ease-in-out;
  -webkit-transform-origin: 0% 0%;
          transform-origin: 0% 0%;
}

.progress-container .progress {
  height: 5px;
  font-size: 18px;
}

.progress-container .aos-animate {
  -webkit-transform: scaleX(1);
          transform: scaleX(1);
}

/* Experience Style */
.cc-experience .cc-experience-header {
  padding-top: 60px;
  padding-right: 0;
  text-align: center;
  color: #fff;
  text-transform: uppercase;
}

/* Education Style */
.cc-education .h5 {
  margin-bottom: 0;
}

.cc-education .cc-education-header {
  padding-top: 60px;
  padding-right: 0;
  text-align: center;
  color: #fff;
}

/* References Style */
.cc-reference .card {
  padding: 40px;
}

.cc-reference img {
  height: 120px;
  width: auto;
}

.cc-reference .h5 {
  margin: 0;
}

.cc-reference .carousel-indicators li {
  background: #a5a3a3;
}

.cc-reference .carousel-indicators .active {
  background-color: #378C3F;
}

.cc-reference .carousel-inner {
  -webkit-box-shadow: none;
          box-shadow: none;
}

@media (max-width: 768px) {
  .cc-reference .cc-reference-header {
    text-align: center;
  }
  .cc-reference .carousel-indicators {
    bottom: 0px;
  }
  .cc-reference ol {
    margin-bottom: 0;
  }
}

/* Contact Information Style */
.cc-contact-information {
  width: 100%;
  position: relative;
  overflow: hidden;
}

.cc-contact-information .cc-contact {
  padding: 8% 0 8% 20%;
}

@media (max-width: 767px) {
  .cc-contact-information .cc-contact {
    padding: 30px 0px 30px 0px;
  }
}

/* Footer */
/* Social button style */
.cc-facebook:hover i {
  color: #3b5998;
}

.cc-twitter:hover i {
  color: #1da1f2;
}

.cc-google-plus:hover i {
  color: #dd4b39;
}

.cc-instagram:hover i {
  color: #405de6;
}

/* Credit Style */
a.credit {
  color: inherit;
  border-bottom: 1px dashed;
  text-decoration: none;
  cursor: pointer;
}

/* Common Style */
.section {
  padding-bottom: 0;
}

</style>
@endsection

@section('content')

    @include('particals.top-info')

@endsection