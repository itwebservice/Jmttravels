<?php
include '../../crm/model/model.php';
$data = mysqli_fetch_array(mysqlQuery('SELECT * FROM `b2c_color_scheme`'));
if (!empty($data)) {
  $btnColor = $data['button_color'];
  $primaryColor = $data['text_primary_color'];
} else {
  $btnColor = '#ff5300';
  $primaryColor = '#f68c34';
}
?>

/*
* Prefixed by https://autoprefixer.github.io
* PostCSS: v8.4.12,
* Autoprefixer: v10.4.4
* Browsers: last 4 version
*/

@import "./_library.less";

/* 1 Reset */
* {
-webkit-box-sizing: border-box;
box-sizing: border-box;
-moz-box-sizing: border-box;
/* Firefox */
margin: 0;
padding: 0;
-webkit-tap-highlight-color: transparent;
zoom: 1;
}
/* preloader */
#loading {
position: fixed;
width: 100%;
height: 100vh;
background: #fff url("https://i.imgur.com/dIamRtt.gif") no-repeat center center;
z-index: 999;
}

html {
font-size: 16px;
min-height: 100%;
}

body {
font-family: "Lato", Arial, Helvetica, sans-serif;
background-color: @white;
color: #838383;
overflow-x: hidden;
}

/* 3) Lists */
ol,
ul {
list-style: none;
margin: 0;
}

/* 6) HTML5 & CSS3 Styles for older browsers */
article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
menu,
nav,
section {
display: block;
}

/* 2.1. Form Elements ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
input.input-text,
select,
textarea,
span.c-custom-select {
background: #f5f5f5;
border: none;
line-height: normal;
}

input.input-text,
textarea,
span.c-custom-select {
padding-left: 15px;
padding-right: 15px;
height: 34px;
}

input.input-text.input-large,
textarea.input-large,
span.c-custom-select.input-large {
height: 43px;
font-size: 1.1667em;
}

input.input-text.input-medium,
textarea.input-medium,
span.c-custom-select.input-medium {
height: 34px;
}

input.input-text.input-small,
textarea.input-small,
span.c-custom-select.input-small {
height: 28px;
}

input.input-text.input-mini,
textarea.input-mini,
span.c-custom-select.input-mini {
height: 19px;
}

input.input-text.white,
textarea.white,
span.c-custom-select.white {
background: @white;
}

textarea {
height: auto;
padding-top: 10px;
padding-bottom: 10px;
}

/* 2.1.1. Select box */
select {
height: 34px;
padding: 8px 0 8px 8px;
}

select option {
padding: 2px 10px;
}

.selector {
position: relative;
min-width: 60px;
line-height: 0;
}

.selector select {
position: absolute;
z-index: 1;
filter: alpha(opacity=0);
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
-moz-opacity: 0;
-khtml-opacity: 0;
opacity: 0;
width: 100%;
-webkit-appearance: menulist-button;
line-height: 30px;
}

.selector span.c-custom-select {
color: #999;
display: inline-block;
line-height: 32px;
padding: 0 10px;
position: relative;
width: 100%;
overflow: hidden;
white-space: nowrap;
}

.selector span.c-custom-select:before {
position: absolute;
right: 0;
top: 0;
content: "";
background: var(--main-bg-color);
width: 24px;
height: 100%;
}

.selector span.c-custom-select:after {
position: absolute;
right: 8px;
top: 15px;
border-color: @white transparent transparent transparent;
border-style: solid;
border-width: 5px 4px 0 4px;
content: "";
}

.selector.sm select,
.selector.sm span.c-custom-select {
height: 26px;
line-height: 26px;
}

.selector.sm span.c-custom-select:after {
top: 10px;
}

.sm input.input-text {
height: 26px;
line-height: 26px;
}

.sm.datepicker-wrap:after {
font-size: 22px;
line-height: 26px;
}

/* 2.1.2. File input box */
.fileinput {
position: relative;
display: inline-block;
min-width: 100px;
}

.fileinput input[type="file"] {
position: relative;
z-index: 2;
filter: alpha(opacity=0);
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
-moz-opacity: 0;
-khtml-opacity: 0;
opacity: 0;
width: 100%;
}

.fileinput .custom-fileinput {
position: absolute;
z-index: 0;
top: 0;
left: 0;
width: 100%;
line-height: normal;
}

.fileinput:after {
display: block;
content: "BROWSE";
position: absolute;
top: 0;
right: 0;
bottom: 0;
z-index: 1;
background: var(--secondary-color);
color: @white;
font-size: 1em;
padding-left: 15px;
padding-right: 15px;
letter-spacing: 0.04em;
font-weight: bold;
vertical-align: middle;
}

/* 2.1.3. Checkbox and Radio */
.checkbox,
.radio {
position: relative;
margin-top: 0;
line-height: 20px;
}

.checkbox:before,
.radio:before {
display: block;
content: "";
position: absolute;
left: 0;
top: 3px;
width: 14px;
height: 14px;
border: 1px solid #d1d1d1;
z-index: 0;
font-family: "soap-icons";
line-height: 12px;
text-align: center;
}

.checkbox.checked:before,
.radio.checked:before {
border-color: var(--primary-color);
color: @white;
background: var(--primary-color);
content: "\e8ba";
}

/* checkbox */
.checkbox label,
.checkbox.label {
font-size: 1.0833em;
line-height: 20px;
color: #9e9e9e;
}

.checkbox input[type="checkbox"] {
position: relative;
z-index: 1;
filter: alpha(opacity=0);
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
-moz-opacity: 0;
-khtml-opacity: 0;
opacity: 0;
}

/* radio */
.radio label,
.radio.label {
font-size: 0.9167em;
line-height: 20px;
}

.radio input[type="radio"] {
position: relative;
z-index: 1;
filter: alpha(opacity=0);
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
-moz-opacity: 0;
-khtml-opacity: 0;
opacity: 0;
}

.radio:before {
background: @white;
border-radius: 50% 50% 50% 50%;
font-size: 1.3333em;
line-height: 13px;
}

.radio.radio-square:before {
border-radius: 0 0 0 0;
}

.radio.checked:before {
content: "\e892";
}

.checkbox-inline,
.radio-inline {
margin-left: 10px;
}

/* 2.1.4. Form */
form label {
color: #999;
text-transform: uppercase;
display: block;
margin-bottom: 5px;
font-weight: normal;
font-size: 0.9167em;
}

form .checkbox label,
form label.checkbox {
font-size: 1.0833em;
text-transform: none;
}

form .radio label,
form label.radio {
font-size: 0.9167em;
}

form .form-group {
margin-bottom: 15px;
}

.sidebar form .form-group {
margin-bottom: 10px;
}

.sidebar form label {
font-size: 0.8333em;
margin-bottom: 3px;
}

.panel-content form label {
font-size: 0.8333em;
margin-bottom: 3px;
}

/* Fourty space */
.box-title,
.post-title,
.post-meta,
.author .name,
.mile,
.title,
.s-title,
.price,
button,
input[type="button"].button,
a.button,
dl,
label,
span.info,
.price-wrapper,
ul.tabs a,
.icon-box.style1,
.icon-box.style2,
.icon-box.style3 .description,
.icon-box.style5,
.search-results-title,
.breadcrumbs {
letter-spacing: 0.04em;
}

/* 2.2. Buttons ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/* 2.2.1. Buttons */

.icon-check {
position: relative;
padding-right: 30px !important;
padding-left: 0 !important;
overflow: hidden;
/*&:hover:after { @include animation(toTopFromBottom, 0.35s, forwards); }*/
}

.icon-check:after {
content: "";
position: absolute;
top: 0;
right: 0;
width: 30px;
height: 100%;
background: url(../../images/icon/icon-check.png) no-repeat center center
#7db921;
}

.icon-check:hover:after {
background-color: #98ce44;
}

.with-icon {
position: relative;
padding: 0 !important;
display: inline-block;
}

.with-icon .icon {
position: absolute;
right: 0;
top: 50%;
margin: -17px 0 0 !important;
width: 30px;
font-size: 18px;
color: #a4a4a4;
background: none;
padding: 0 !important;
height: auto;
}

.with-icon .input-text {
padding-right: 40px !important;
}

.with-icon.input-large .icon {
width: 43px;
height: 43px;
margin-top: -21px !important;
font-size: 22px;
}

.with-icon.input-large .input-text {
padding-right: 48px !important;
}

/* 2.2.2. Alert message */

/* 2.2.3. Info box */
.info-box {
padding: 20px 25px;
border: 1px solid var(--primary-color);
position: relative;
}

.info-box .close {
color: var(--primary-color);
}

.info-box p {
font-size: 1.1667em;
}

.info-box > *:last-child {
margin-bottom: 0;
}

/* 2.2.5. Dropcap */
.dropcap:first-letter {
float: left;
color: var(--primary-color);
font-size: 4.153em;
line-height: 0.8667em;
padding: 0;
margin-right: 6px;
font-weight: bold;
text-transform: uppercase;
display: block;
}

.dropcap.colored:first-letter {
color: @white;
background: var(--primary-color);
padding: 4px 4px;
margin-top: 3px;
margin-right: 10px;
}

/* 2.2.8. Hover effect */
.hover-effect {
display: block;
position: relative;
background: none;
overflow: hidden;
/*z-index: 0;*/
/*color skin*/
/* style1 : checked icon */
}

.hover-effect:after {
content: "";
position: absolute;
left: 0;
top: 0;
width: 100%;
height: 100%;
visibility: hidden;
-o-transition: all 0.4s ease-out;
-webkit-transition: all 0.4s ease-out;
transition: all 0.4s ease-out;
-webkit-transform: rotateY(180deg) scale(0.5, 0.5);
-ms-transform: rotateY(180deg) scale(0.5, 0.5);
transform: rotateY(180deg) scale(0.5, 0.5);
background: url(../../images/icon/hover-effect.png) no-repeat center;
filter: alpha(opacity=0);
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
-moz-opacity: 0;
-khtml-opacity: 0;
opacity: 0;
background-color: rgba(1, 183, 242, 0.6);
}

.hover-effect img {
display: block;
position: relative;
-o-transition: all 0.4s ease-out;
-webkit-transition: all 0.4s ease-out;
transition: all 0.4s ease-out;
-webkit-backface-visibility: hidden;
}

.hover-effect:hover:after {
visibility: visible;
-webkit-transform: rotateY(0deg) scale(1, 1);
-ms-transform: rotateY(0deg) scale(1, 1);
transform: rotateY(0deg) scale(1, 1);
filter: alpha(opacity=100);
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
-moz-opacity: 1;
-khtml-opacity: 1;
opacity: 1;
}

.hover-effect:hover img {
-webkit-transform: scale(1.2);
-ms-transform: scale(1.2);
transform: scale(1.2);
}

.hover-effect.yellow:after {
background-color: rgba(255, 255, 40, 0.6);
}

.hover-effect.style1:after {
color: @white;
background: none;
content: "\e8ba";
font-family: "soap-icons";
font-size: 1.6667em;
text-align: center;
line-height: 50px;
border: 2px solid @white;
border-radius: 50% 50% 50% 50%;
width: 50px;
height: 50px;
left: 50%;
top: 50%;
margin-left: -25px;
margin-top: -25px;
}

.hover-effect.style1:hover {
background: var(--primary-color);
}

.hover-effect.style1:hover img {
filter: alpha(opacity=50);
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
-moz-opacity: 0.5;
-khtml-opacity: 0.5;
opacity: 0.5;
}

.selected-effect {
display: block;
position: relative;
background: none;
overflow: hidden;
background: var(--primary-color);
}

.selected-effect img {
filter: alpha(opacity=50);
-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
-moz-opacity: 0.5;
-khtml-opacity: 0.5;
opacity: 0.5;
}

.selected-effect:after {
position: absolute;
color: @white;
background: none;
content: "\e8ba";
font-family: "soap-icons";
font-size: 1.6667em;
text-align: center;
line-height: 50px;
border: 2px solid @white;
border-radius: 50% 50% 50% 50%;
width: 50px;
height: 50px;
left: 50%;
top: 50%;
margin-left: -25px;
margin-top: -25px;
}

.animated .hover-effect {
z-index: 0;
}

/* 2.2.9. Social icons */
.social-icons li {
float: left;
text-align: center;
}

.social-icons li a {
width: 32px;
margin-right: 4px;
height: 32px;
display: inline-block;
background: #d9d9d9;
color: @white;
line-height: 32px;
font-size: 1.3333em;
text-decoration: none;
-o-transition: opacity 0.3s ease-in;
-webkit-transition: opacity 0.3s ease-in;
transition: opacity 0.3s ease-in;
}

.social-icons li a .icon {
font-size: 13px;
line-height: 12px;
display: inline-block;
vertical-align: middle;
}

.social-icons li a:hover {
background: var(--primary-color);
}

.social-icons li:last-child {
margin-right: 0;
}

.contact-details {
font-style: normal;
}

.contact-details .contact-phone {
color: #2d3e52;
font-size: 1.6667em;
}

.contact-details .contact-phone i {
color: var(--primary-color);
}

.contact-details .contact-email {
color: var(--primary-color);
font-size: 1.1667em;
padding: 0 24px;
line-height: 2em;
}

/* 2.4. Skin Color ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
.title {
color: #2d3e52;
}

/* 2.5. Positioning ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
.middle-block {
position: relative;
display: block;
overflow: hidden;
}

.middle-block .middle-item {
position: absolute;
}

.middle-block img.middle-item {
max-width: none;
min-width: 100%;
}

/* 3.3. Page Title ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
.page-title-container {
height: 56px;
background: #2d3e52;
}

.page-title-container .page-title .entry-title {
line-height: 56px;
color: @white;
margin: 0;
}

.page-title-container .breadcrumbs {
height: 100%;
}

.page-title-container .breadcrumbs li {
float: left;
line-height: 56px;
display: inline;
margin-left: 5px;
font-size: 0.8333em;
font-weight: bold;
text-transform: uppercase;
}

.page-title-container .breadcrumbs li a {
padding-right: 5px;
color: @white;
}

.page-title-container .breadcrumbs li a:hover {
color: var(--primary-color);
}

.page-title-container .breadcrumbs li:after {
content: "/";
color: #5a7ca3;
}

.page-title-container .breadcrumbs li:last-child:after {
content: "";
}

.page-title-container .breadcrumbs li.active {
color: var(--secondary-color);
}

/* 7. jQuery UI Elements ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
/* 7.1. UI Slider ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

.filters-container #rating {
font-size: 24px;
}

.filters-container #rating,
.editable-rating {
display: inline-block;
}

.filters-container #rating.ui-widget-content,
.editable-rating.ui-widget-content {
background: none;
border-radius: 0 0 0 0;
}

.filters-container #rating.ui-slider-horizontal,
.editable-rating.ui-slider-horizontal {
height: auto;
}

.filters-container #rating.ui-slider-horizontal .ui-slider-handle,
.editable-rating.ui-slider-horizontal .ui-slider-handle {
margin: 0;
width: 0;
height: 0;
padding: 0;
top: 0;
visibility: hidden;
}

/* 7.2. DatePicker ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
button.ui-button::-moz-focus-inner {
border: 0;
padding: 0;
}

.datepicker-wrap {
position: relative;
}

.datepicker-wrap .ui-datepicker-trigger {
display: none;
}

.datepicker-wrap:after {
display: block;
font-family: "itours";
content: "\44";
font-size: 14px;
color: @white;
position: absolute;
right: 0;
top: 0;
bottom: 0;
width: 30px;
height: 33px;
text-align: center;
line-height: 34px;
background: var(--main-bg-color);
}

.datepicker-wrap.yellow:after {
background: var(--secondary-color);
}

.datepicker-wrap.transparent:after {
background-color: transparent;
color: var(--secondary-color);
}

.ui-datepicker {
width: 20em;
padding: 0;
display: none;
background: @white;
border: 1px solid var(--secondary-color);
z-index: 101 !important;
}

.ui-datepicker .ui-datepicker-header {
position: relative;
padding: 0.2em 0;
background: var(--secondary-color);
}

.ui-datepicker .ui-datepicker-prev,
.ui-datepicker .ui-datepicker-next {
position: absolute;
top: 11px;
cursor: pointer;
}

.ui-datepicker .ui-datepicker-prev.ui-state-disabled,
.ui-datepicker .ui-datepicker-next.ui-state-disabled {
visibility: hidden;
}

.ui-datepicker .ui-datepicker-prev:before,
.ui-datepicker .ui-datepicker-next:before {
content: "";
display: block;
width: 0;
height: 0;
border-top: 5px solid transparent;
border-bottom: 5px solid transparent;
}

.ui-datepicker .ui-datepicker-prev {
left: 24px;
}

.ui-datepicker .ui-datepicker-prev:before {
border-right: 8px solid @white;
}

.ui-datepicker .ui-datepicker-next {
right: 24px;
}

.ui-datepicker .ui-datepicker-next:before {
border-left: 8px solid @white;
}

.ui-datepicker .ui-datepicker-prev span,
.ui-datepicker .ui-datepicker-next span {
display: none;
}

.ui-datepicker .ui-datepicker-title {
margin: 5px;
text-align: center;
color: @white;
font-size: 1.1667em;
font-weight: bold;
}

.ui-datepicker .ui-datepicker-title select {
font-size: 1em;
margin: 1px 0;
}

.ui-datepicker select.ui-datepicker-month-year {
width: 100%;
}

.ui-datepicker select.ui-datepicker-month,
.ui-datepicker select.ui-datepicker-year {
width: 49%;
}

.ui-datepicker table {
width: 100%;
font-size: 12px;
border-collapse: collapse;
}

.ui-datepicker th {
width: 30px;
height: 30px;
line-height: 30px;
background: #f5f5f5;
}

.ui-datepicker th span {
display: block;
text-align: center;
font-size: 1.1667em;
font-weight: normal;
color: var(--secondary-color);
}

.ui-datepicker span.ui-datepicker-month {
font-weight: bold;
}

.ui-datepicker .ui-datepicker-calendar td {
vertical-align: middle;
text-align: center;
}

.ui-datepicker .ui-datepicker-calendar td a,
.ui-datepicker .ui-datepicker-calendar td span {
color: inherit;
display: block;
height: 30px;
line-height: 30px;
}

.ui-datepicker .ui-datepicker-calendar td.ui-state-disabled span {
color: #dbdbdb;
}

.ui-datepicker .ui-datepicker-calendar td.ui-datepicker-current-day a,
.ui-datepicker .ui-datepicker-calendar td a:hover {
background: var(--secondary-color);
color: @white;
}

.ui-datepicker .ui-datepicker-calendar td.ui-datepicker-today a {
position: relative;
}

.ui-datepicker .ui-datepicker-calendar td.ui-datepicker-today a:before {
content: "";
border-right: 5px solid var(--secondary-color);
border-top: 5px solid transparent;
position: absolute;
bottom: 4px;
right: 4px;
}

.ui-datepicker.yellow {
border: 1px solid var(--secondary-color);
}

.ui-datepicker.yellow .ui-datepicker-header {
background: var(--secondary-color);
}

.ui-datepicker.yellow th span {
color: var(--secondary-color);
}

.ui-datepicker.yellow .ui-datepicker-calendar td.ui-datepicker-current-day a,
.ui-datepicker.yellow .ui-datepicker-calendar td a:hover {
background: var(--secondary-color);
}

.ui-datepicker.yellow .ui-datepicker-calendar td.ui-datepicker-today a:before {
border-right-color: var(--secondary-color);
}

.ui-datepicker.green {
border: 1px solid #98ce44;
}

.ui-datepicker.green .ui-datepicker-header {
background: #98ce44;
}

.ui-datepicker.green th span {
color: #98ce44;
}

.ui-datepicker.green .ui-datepicker-calendar td.ui-datepicker-current-day a,
.ui-datepicker.green .ui-datepicker-calendar td a:hover {
background: #98ce44;
}

.ui-datepicker.green .ui-datepicker-calendar td.ui-datepicker-today a:before {
border-right-color: #98ce44;
}

.ui-datepicker.blue {
border: 1px solid var(--primary-color);
}

.ui-datepicker.blue .ui-datepicker-header {
background: var(--primary-color);
}

.ui-datepicker.blue th span {
color: var(--primary-color);
}

.ui-datepicker.blue .ui-datepicker-calendar td.ui-datepicker-current-day a,
.ui-datepicker.blue .ui-datepicker-calendar td a:hover {
background: var(--primary-color);
}

.ui-datepicker.blue .ui-datepicker-calendar td.ui-datepicker-today a:before {
border-right-color: var(--primary-color);
}

.ui-datepicker.dark-blue {
border: 1px solid #2d3e52;
}

.ui-datepicker.dark-blue .ui-datepicker-header {
background: #2d3e52;
}

.ui-datepicker.dark-blue th span {
color: #2d3e52;
}

.ui-datepicker.dark-blue .ui-datepicker-calendar td.ui-datepicker-current-day a,
.ui-datepicker.dark-blue .ui-datepicker-calendar td a:hover {
background: #2d3e52;
}

.ui-datepicker.dark-blue
.ui-datepicker-calendar
td.ui-datepicker-today
a:before {
border-right-color: #2d3e52;
}

input.input-text,
textarea,
.selector select + .c-custom-select {
-o-transition: border-color 0.15s ease-in-out 0s,
box-shadow 0.15s ease-in-out 0s;
-webkit-transition: border-color 0.15s ease-in-out 0s,
box-shadow 0.15s ease-in-out 0s;
-webkit-transition: border-color 0.15s ease-in-out 0s,
-webkit-box-shadow 0.15s ease-in-out 0s;
transition: border-color 0.15s ease-in-out 0s,
-webkit-box-shadow 0.15s ease-in-out 0s;
-o-transition: border-color 0.15s ease-in-out 0s,
box-shadow 0.15s ease-in-out 0s;
transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s,
-webkit-box-shadow 0.15s ease-in-out 0s;
border: 1px solid transparent;
cursor: text;
border-radius: 0;
}

input.input-text:focus,
textarea:focus,
.selector select:focus + .c-custom-select {
outline: none;
border: 1px solid var(--primary-color);
-webkit-box-shadow: 0 0 8px rgba(1, 183, 242, 0.6);
box-shadow: 0 0 8px rgba(1, 183, 242, 0.6);
}

.column-5-no-margin > * {
float: left;
}

.column-5-no-margin:after {
clear: both;
content: "";
display: table;
}

.column-5-no-margin > *:nth-child(5n + 1) {
clear: both;
}

.column-5-no-margin > * {
width: 20%;
}

@media (max-width: 768px) {
.column-5-no-margin > * {
width: 50%;
}

.column-5-no-margin > *:nth-child(5n + 1) {
clear: none;
}

.column-5-no-margin > *:nth-child(2n + 1) {
clear: both;
}
}

/***Modal***/
.modal-open .modal {
width: 100%;
height: 100vh;
overflow-y: scroll;
}

.modal-body {
position: relative;
}

#view_log_modal .modal-body {
padding: 0px 15px 15px 15px !important;
}

.modal-content {
border-top: 4px solid var(--secondary-color);
}

.modal-header {
padding: 5px;
}

h4.modal-title {
margin: 0;
line-height: 1.42857143;
text-transform: capitalize;
font-size: 22px;
padding-left: 5px;
font-weight: 300;
}

h6 {
font-size: 16px;
color: #fff;
font-weight: 500;
padding-bottom: 40px;
}

.modal-body h4 {
margin: 0px;
font-size: 17px;
font-weight: 400;
padding: 5px;
}

.sliderRangeInfo span {
font-size: 11px;
font-weight: 600;
display: "inline-block";
}

#currency_dropdown
.select2-container--default
.select2-selection--single
.select2-selection__arrow {
right: 20px;
}

/************************* Style By Harshad Ambaliya Start ***********************/
/***************** Home Page Start *******************/
@import
url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

// body,
.ts-font-poppins {
font-family: "Poppins", sans-serif;
}

form label {
line-height: 24px;
font-weight: 400;
font-style: normal;
color: #666666;
font-size: 14px;
}

a {
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

a:hover {
text-decoration: none;
}

.ts-who-are-section {
padding: 75px 0;
background-color: #f5f5f5;
font-family: "Poppins", sans-serif;
}

.ts-section-subtitle {
color: #666666;
font-weight: 300;
text-transform: uppercase;
letter-spacing: 1px;
display: inline-block;
margin-bottom: 0px;
font-size: 16px;
}

.ts-section-title {
font-size: 30px;
line-height: 50px;
margin-bottom: 10px;
font-style: normal;
font-weight: 500;
color: #444444;
}

.ts-section-subtitle-content {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: end;
-ms-flex-align: end;
align-items: flex-end;
}

.ts-section-subtitle-icon {
position: relative;
margin-left: 65px;
}

.ts-section-subtitle-icon::before {
content: "";
width: 55px;
height: 2px;
background-color: var(--main-primary-color);
display: inline-block;
position: absolute;
right: 100%;
bottom: 0;
}

.ts-section-subtitle-icon img {
width: 35px;
height: 35px;
-o-object-fit: contain;
object-fit: contain;
margin-left: 5px;
}

.ts-section-description {
color: #666666;
font-size: 14px;
line-height: 24px;
text-align: justify;
}

.ts-vision-card {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: start;
-ms-flex-align: start;
align-items: flex-start;
}

.ts-vision-card-icon {
padding: 0 15px;
}

.ts-vision-icon__inner {
background-color: #f68c34;
width: 60px;
height: 60px;
border-radius: 50%;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
}

.ts-vision-icon__inner svg {
width: 30px;
}

.ts-vision-card-body {
padding: 0 15px;
}

.ts-vision-title {
font-size: 21px;
line-height: 31px;
margin-bottom: 10px;
color: #444444;
}

.ts-vision-description {
color: #666666;
font-size: 14px;
margin-bottom: 0;
}

.ts-who-are-img {
margin-bottom: 35px;
padding-top: 70px;
}

.ts-adventure-section {
padding: 100px 0;
text-align: center;
background-image: url(../../images/adventure-back.jpg);
background-size: cover;
background-position: center;
// background-attachment: fixed;
}

.ts-adventure-section .ta-section-title {
color: #ffffff;
text-transform: uppercase;
margin-bottom: 40px;
width: 720px;
max-width: 100%;
margin-left: auto;
margin-right: auto;
line-height: 50px;
margin-bottom: 10px;
font-style: normal;
font-weight: 500;
}

.ts-destinations-section {
padding: 75px 0;
font-family: "Poppins", sans-serif;
background-image: url(../../images/desitination-back.jpg);
background-size: cover;
background-position: center;
background-attachment: fixed;
}

.ts-blog-card {
background-color: #ffffff;
}

.ts-blog-card-img {
position: relative;
}

.ts-blog-card-body {
padding: 30px;
}

.ts-blog-card-title {
font-size: 21px;
color: #444444;
line-height: 31px;
font-weight: 500;
}

.ts-blog-card-title:hover {
color: #f68c34;
}

.ts-blog-time {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
margin-bottom: 6px;
margin-top: 6px;
}

.ts-blog-time a,
.ts-blog-time span {
line-height: 26px;
font-size: 13px;
color: #666666;
}

.ts-blog-time a:hover {
color: #f68c34;
}

.ts-blog-time svg {
width: 15px;
margin-right: 5px;
}

.ts-blog-card-description {
color: #666666;
font-size: 14px;
line-height: 24px;
}

.ts-destinations-section .ts-blog-card-description {
height: 72px;
overflow: hidden;
}

.ts-blog-card-description-date {
font-size: 12px;
line-height: 26px;
}

.ts-blog-card-link {
text-align: center;
display: block;
padding: 11px 30px;
border-top: 1px solid #f68c34;
color: #666666;
text-transform: uppercase;
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-blog-card-link{
background-color: var(--main-bg-color);
color: #ffffff;
text-decoration: none;
}
.ts-blog-card-link:hover{
background: #444444 !important;
color: #ffffff;
-webkit-box-shadow: none !important;
box-shadow: none !important;
}

.ts-blog-card-img-link {
width: 100%;
height: 100%;
position: absolute;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
background-color: var(--main-bg-color);
opacity: 0;
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-blog-card-img-link svg {
width: 32px;
}

.ts-blog-card-img-link:hover {
opacity: 0.8;
}

.ts-blog-content .col {
margin-bottom: 30px;
}

.ts-destinations-section .ts-section-title {
margin-bottom: 50px;
}

.ts-rate-section {
font-family: "Poppins", sans-serif;
padding: 100px 0;
background-image: url(../../images/rate-back.jpg);
background-size: cover;
background-position: center;
// background-attachment: fixed;
background-position: center !important;
}

.ts-rate-section .ts-section-title {
color: #ffffff;
}

.ts-rate-section .ts-section-description {
color: #ffffff;
}

.ts-available-rate-list {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: justify;
-ms-flex-pack: justify;
justify-content: space-between;
}

.ts-available-rate-item {
text-align: center;
color: #fff;
padding: 0 15px;
}

.ts-available-rate-icon {
background: var(--main-primary-color);
color: #ffffff;
width: 100px;
height: 100px;
border: 1px solid rgba(255, 255, 255, 0.6);
border-radius: 100%;
margin: 0 auto 10px;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
}

.ts-available-rate-icon img {
width: 40px;
height: 40px;
-o-object-fit: contain;
object-fit: contain;
-o-object-position: center;
object-position: center;
}

.ts-available-rate-title {
font-size: 16px;
margin-bottom: 0;
}

.ts-testimonial-section {
padding: 75px 0;
font-family: "Poppins", sans-serif;
background-image: url(../../images/desitination-back.jpg);
background-size: cover;
background-position: center;
background-attachment: fixed;
}

.ts-testimonial-section .ts-section-title {
margin-bottom: 50px;
}

.ts-testimonial-name {
color: #444444;
font-size: 24px;
margin-bottom: 20px;
padding-bottom: 20px;
border-bottom: 1px solid var(--main-primary-color);
position: relative;
}

.ts-testimonial-name::before {
content: "";
position: absolute;
top: calc(100% - 1.5px);
width: 205px;
height: 3px;
background-color: var(--main-primary-color);
border-radius: 3px;
}

.ts-testimonial-description {
font-size: 14px;
color: #666666;
}

.ts-readmore-link {
color: var(--main-bg-color);
font-size: 14px;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}

.ts-readmore-link:hover {
color: #444444;
text-decoration: none;
}

.ts-readmore-link svg {
width: 5px;
margin-left: 10px;
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-readmore-link:hover svg {
margin-left: 20px;
}

.ts-testimonial-slider .owl-nav {
position: absolute;
top: 50%;
left: 0;
right: 0;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-pack: justify;
-ms-flex-pack: justify;
justify-content: space-between;
}

.ts-testimonial-slider .owl-nav button {
opacity: 0.5;
width: 20px;
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-testimonial-slider .owl-nav button img {
max-width: 100%;
}

.ts-testimonial-slider .owl-nav button:hover {
opacity: 1;
}

.ts-update-section .ts-section-title {
margin-bottom: 40px;
}

.ts-update-section {
font-family: "Poppins", sans-serif;
padding: 75px 0;
background-color: #f8f8f8;
}

.ts-update-title {
font-size: 24px;
color: #444444;
line-height: 34px;
font-weight: 500;
display: block;
margin-bottom: 10px;
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-update-title:hover {
color: #f68c34;
text-decoration: none;
}

.ts-update-info-list {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
margin-bottom: 20px;
}

.ts-update-info-item i {
margin-right: 5px;
}

.ts-update-info-item:not(:last-child) {
margin-right: 15px;
}

.ts-update-info-text {
font-size: 14px;
color: #666666;
}

.ts-update-info-text:hover {
color: #f68c34;
}

.ts-updates-description {
font-size: 14px;
line-height: 24px;
}

.btn {
text-align: center;
cursor: pointer;
text-transform: uppercase;
font-weight: 300;
font-size: 14px;
padding: 10px 40px;
border-radius: 22px;
border: none;
-webkit-box-shadow: 0 8px 6px -6px rgba(50, 51, 51, 0.4);
box-shadow: 0 8px 6px -6px rgba(50, 51, 51, 0.4);
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.btn-primary {
background: var(--main-bg-color);
color: #ffffff;
}

.btn-primary:hover {
background: #444444 !important;
color: #ffffff;
-webkit-box-shadow: none !important;
box-shadow: none !important;
}

.btn-primary:focus,
.btn-primary:active {
background: #444444 !important;
color: #ffffff;
-webkit-box-shadow: none !important;
box-shadow: none !important;
}

.btn:hover {
-webkit-box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.abt-btn {
justify-content: center;
align-items: center;
display: flex;
}

.ts-update-section .row {
margin-bottom: 40px;
}

.ts-contact-section {
padding: 50px 0 !important;
font-family: "Poppins", sans-serif;
background-image: url(../../images/desitination-back.jpg);
background-size: cover;
background-position: center;
}

.ts-contact-info-icon {
background: #ffffff;
color: var(--main-primary-color);
width: 50px;
height: 50px;
border-radius: 50%;
font-size: 20px;
-webkit-box-shadow: 0 8px 6px -6px rgb(50 51 51 / 40%);
box-shadow: 0 8px 6px -6px rgb(50 51 51 / 40%);
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
}

.ts-contact-info-link {
color: #838383;
font-size: 16px;
line-height: 26px;
font-weight: 500;
width: calc(100% - 80px);
margin-left: auto;
}

.ts-contact-info-link:hover {
color: #666666;
}

.ts-contact-info-list {
margin-bottom: 40px;
}

.ts-contact-info-item {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}

.ts-contact-info-item:not(:last-child) {
margin-bottom: 40px;
}

.ts-contact-section .ts-section-title {
margin-bottom: 30px;
}

form label {
line-height: 24px;
font-weight: 400;
font-style: normal;
color: #666666;
font-size: 14px;
text-transform: capitalize;
}

.landing-form-tabs label {
color: #201a1a;
font-size: 10px;
line-height: 10px;
}

.form-control {
border-color: #ced4da;
font-size: 14px;
line-height: 24px;
color: #666666;
font-weight: 300;
}

.c-footer .footer-wrapper {
background-color: #f5f5f5;
}

.c-footer h2 {
border-bottom: 1px solid #999;
width: -webkit-max-content;
width: -moz-max-content;
width: max-content;
padding-bottom: 10px;
}

.c-footer .c-footerLink li a {
font-size: 16px;
color: #827e7e;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
float: left;
}

.c-footer .footer-wrapper {
padding: 40px 0 30px;
}

.ts-social-media-list {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
}

.ts-social-media-item {
margin-right: 20px;
}

/***************** Sticky social media *******************/
.s-icons {
top: 30%;
left: 0;
transform: translateY(50%);
position: fixed;
z-index: 100;
}

.s-icons ul {
padding: initial;
}

.s-icons ul li {
height: 40px;
width: 40px;
list-style: none;
padding-left: 15px;
padding-top: 6px;
margin-top: 5px;
color: #fff;
}
.fb {
background: #4267b2;
}
.twit {
background: #1da1f2;
}
.wapp {
background: #25d366;
}
.insta {
background: rgb(225, 48, 108);
}
.link {
background: #0e76a8;
}
.yt {
background: #ff0000;
}
/***************** End Sticky social media *******************/

/***************** Partner slider *******************/
.logo-slider img{
width: 100%;
}

.logo-slider .slideitem{
background-color: #fff;
box-shadow: 0 4px 5px #cacaca;
border-radius: 8px;
padding: 15px;
border: 2px solid #111;
}
.logo-slider .slick-slide{
margin:15px;

}
.slick-dots li.slick-active button:before{
color:#ff5722;
}
.slick-dots li button:before{
font-size: 12px;
}
.slick-next:before,
.slick-prev:before{
color: #ff8159;
font-size: 24px;
}
.slideitem:hover{
display: block;
transition: all ease 0.3s;
transform: scale(1.1) translateY(-5px);
}

/***************** End Partner slider *******************/

/***************** Home Page End *******************/

/***************** About Page Start *******************/
.ts-inner-landing-section {
position: relative;
}

.ts-inner-landing-content {
position: absolute;
top: 50%;
left: 0;
width: 100%;
text-align: center;
}

.ts-reason-section {
padding: 100px 0;
background-color: #f5f5f5;
}

.ts-reason-card {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
background-color: #fff;
padding: 20px;
border-radius: 10px;
height: 100%;
}

.ts-reason-icon__inner {
background-color: var(--main-primary-color);
width: 60px;
height: 60px;
border-radius: 50%;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
}

.ts-reason-icon__inner svg {
width: 30px;
}

.ts-reason-card-icon {
margin-right: 20px;
}

.ts-reason-card-title {
font-size: 21px;
line-height: 31px;
margin-bottom: 10px;
color: #444444;
}

.ts-reason-card-description {
color: #666666;
font-size: 14px;
margin-bottom: 0;
}

.ts-reason-section .ts-section-title {
margin-bottom: 30px;
}

.ts-reason-section .col {
margin-bottom: 30px;
}

.ts-special-img img {
min-height: 400px;
width: 100%;
-o-object-fit: cover;
object-fit: cover;
-o-object-position: center;
object-position: center;
}

.ts-special-content {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
height: 100%;
padding: 30px 25px;
background-image: url(../../images/desitination-back.jpg);
background-size: cover;
background-position: center;
background-attachment: fixed;
}

.ts-special-content .ts-section-title {
font-size: 32px;
}

.ts-customer-testimonial-section {
padding: 100px 0;
}

.ts-customer-testimonial-card {
background-color: #f5f5f5;
padding: 0 20px 20px;
border-radius: 10px;
-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
margin-top: 25px;
}

.ts-customer-testimonial-img {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: end;
-ms-flex-align: end;
align-items: flex-end;
top: -25px;
position: relative;
}

.ts-customer-testimonial-img img {
width: 70px;
height: 70px;
border-radius: 50%;
-o-object-fit: cover;
object-fit: cover;
-o-object-position: center;
object-position: center;
}

.ts-customer-testimonial-name {
font-size: 20px;
line-height: 31px;
margin-bottom: 10px;
color: #444444;
margin-left: 20px;
}

.ts-rating-list {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}

.ts-rating-item {
color: #f68c34;
margin-right: 5px;
}

.ts-customer-testimonial-section .col {
margin-bottom: 30px;
}

.ts-customer-testimonial-section .ts-section-title {
margin-bottom: 30px;
}

/***************** About Page End *******************/

/***************** Contact Page Start *******************/
.ts-contact-detail {
padding: 30px 20px;
background-color: #ffffff;
}

.ts-contact-title {
font-size: 22px;
}

.ts-contact-description {
font-size: 14px;
margin-bottom: 0;
color: #838383;
}

.ts-contact-detail__inner:not(:last-child) {
margin-bottom: 30px;
padding-bottom: 30px;
border-bottom: 1px solid #838383;
}

.ts-contact-title i {
margin-right: 10px;
}

/***************** Contact Page End *******************/
/***************** Careers Page Start *******************/
.ts-accordion .btn {
-webkit-box-shadow: none;
box-shadow: none;
padding: 0;
color: #838383;
font-weight: 500;
display: block;
width: 100%;
text-align: left;
position: relative;
}

.ts-accordion .btn:after,
.ts-accordion .btn:before {
content: "";
width: 15px;
height: 2px;
background-color: #838383;
position: absolute;
top: 50%;
right: 0;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-accordion .btn:after {
-webkit-transform: translateY(-50%) rotate(90deg);
-ms-transform: translateY(-50%) rotate(90deg);
transform: translateY(-50%) rotate(90deg);
}

.ts-accordion .btn[aria-expanded="true"]:after {
-webkit-transform: translateY(-50%) rotate(0deg);
-ms-transform: translateY(-50%) rotate(0deg);
transform: translateY(-50%) rotate(0deg);
opacity: 0;
}

.ts-accordion .card {
margin-bottom: 15px;
}

.ts-accordion .card-header {
background-color: #fff;
}

.ts-accordion .card-body {
font-size: 14px;
line-height: 24px;
}

.ts-careers-apply-content {
padding: 30px 20px;
background-color: #fff;
}

.ts-careers-apply-title {
font-size: 22px;
color: #444444;
margin-bottom: 15px;
}

.ts-careers-apply-content input[type="file"].form-control {
height: auto;
}

/***************** Careers Page End *******************/
/***************** BLog Page Start *******************/
.ts-blog-info .ts-blog-time {
margin-bottom: 0;
}

.ts-blog-info {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
margin-bottom: 15px;
padding-bottom: 15px;
border-bottom: 1px solid #838383;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
}

.ts-blog-info .ts-blog-time:not(:last-child) {
margin-right: 15px;
}

.ts-blog-info .ts-blog-time i {
margin-right: 10px;
}

.ts-blog-content .ts-blog-card-description {
margin-bottom: 0;
}

.ts-blog-content .ts-blog-card-img img {
height: 210px;
-o-object-fit: cover;
object-fit: cover;
-o-object-position: center;
object-position: center;
width: 100%;
}

.ts-single-blog-content.ts-blog-content .ts-blog-card-img img {
-o-object-fit: contain;
object-fit: contain;
height: 300px;
}

.dream-destinations .ts-blog-card-img img {
height: 100%;
}

.ts-pagination .pagination {
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
}

.ts-pagination .page-link {
color: #f68c34;
}

.ts-pagination .page-item.active .page-link {
background-color: #f68c34;
border-color: #f68c34;
}

.scrollup {
width: 40px;
height: 40px;
opacity: 1;
position: fixed;
bottom: 200px;
right: 20px;
display: none;
text-indent: -9999px;
background: url(../../images/scroll-top-arrow.png) no-repeat left top;
z-index: 9001;
display: block;
}

.ts-all-blog-content .ts-blog-card-img img {
height: 350px;
-o-object-fit: contain;
object-fit: contain;
}

.ts-all-blog-content .ts-blog-card-description {
height: 216px;
overflow: hidden;
}

/***************** BLog Page End *******************/

/***************** Best Of Place Page Start *******************/
.ts-best-place-section .ts-blog-info {
-webkit-box-pack: justify;
-ms-flex-pack: justify;
justify-content: space-between;
margin-top: 40px;
}

.ts-best-place-section .ts-blog-info .ts-blog-time.ml-auto:last-child {
margin-left: 0 !important;
}

.ts-best-place-section .ts-blog-time {
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}

.ts-best-place-section .ts-blog-time i {
color: #f68c34;
}

.ts-best-place-img {
margin-bottom: 20px;
}

.nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
background-color: #f68c34;
}

.nav-pills .nav-link {
background-color: #666;
color: #fff;
}

.ts-tab-content {
background-color: #fff;
padding: 20px;
}

.ts-tab-content__inner .card {
border: none;
margin-bottom: 10px;
}

.ts-tab-content__inner .card-header {
border-bottom: none;
}

.ts-tab-content__inner .btn {
-webkit-box-shadow: none;
box-shadow: none;
padding: 0;
color: #000;
font-weight: 600;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}

.ts-tab-content__inner .btn:active,
.ts-tab-content__inner .btn:focus,
.ts-tab-content__inner .btn:hover {
text-decoration: none;
}

.ts-accordian-icon {
width: 26px;
height: 26px;
background-color: #000;
display: block;
margin-right: 15px;
position: relative;
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-accordian-icon:after,
.ts-accordian-icon:before {
content: "";
position: absolute;
width: 14px;
height: 3px;
background-color: #fff;
top: 50%;
left: 50%;
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-accordian-icon:before {
-webkit-transform: translate(-50%, -50%) rotate(90deg);
-ms-transform: translate(-50%, -50%) rotate(90deg);
transform: translate(-50%, -50%) rotate(90deg);
}

.ts-tab-content__inner .btn[aria-expanded="true"] .ts-accordian-icon {
background-color: #f68c34;
}

.ts-tab-content__inner .btn[aria-expanded="true"] .ts-accordian-icon:before {
opacity: 0;
-webkit-transform: translate(-50%, -50%) rotate(0deg);
-ms-transform: translate(-50%, -50%) rotate(0deg);
transform: translate(-50%, -50%) rotate(0deg);
}

.ts-tours-night-list {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
margin-top: 15px;
margin-bottom: 15px;
}

.ts-tours-night-item {
font-size: 14px;
padding: 5px 10px;
background-color: #444444;
color: #fff;
margin-right: 10px;
}

.ts-tours-night-name-item {
background-color: #f68c34;
}

.ts-best-place-landing-section > img {
height: 240px;
width: 100%;
-o-object-fit: cover;
object-fit: cover;
-o-object-position: center;
object-position: center;
}

.ts-best-place-landing-section .ts-inner-landing-content {
position: static;
padding: 100px 0 0;
}

.ts-best-place-landing-section .ts-section-title {
color: #fff;
text-align: left;
margin-bottom: 0;
}

.ts-best-place-section {
padding-top: 0;
}

.pad-top {
padding-top: 18px;
}

.ts-best-place-enquiry-content {
background: #fff;
border: 1px solid rgba(0, 0, 0, 0.1);
padding: 50px 20px;
}

.ts-best-place-enquiry-content .btn {
margin: auto;
display: block;
}

.ts-contact-form-title {
font-size: 21px;
margin-bottom: 30px;
text-align: center;
color: #444444;
}

.ts-best-place-price-header {
background: #ed710a;
padding: 10px;
}

.ts-best-place-price-header label {
color: #ffffff;
text-align: center;
font-weight: 600;
display: block;
}

.ts-best-place-price-body {
background: #f68c34;
padding: 25px 10px;
color: #ffffff;
text-align: center;
}

.ts-best-place-price-body p {
margin-bottom: 0;
color: #ffffff;
text-align: center;
font-weight: 500;
}

.ts-best-place-slider {
margin-bottom: 30px;
position: relative;
}

.ts-best-place-slider .item img {
height: 350px;
-o-object-fit: cover;
object-fit: cover;
-o-object-position: center;
object-position: center;
width: 100%;
}

.ts-best-place-slider.owl-carousel .owl-nav button.owl-next,
.ts-best-place-slider.owl-carousel .owl-nav button.owl-prev,
.ts-best-place-slider.owl-carousel button.owl-dot {
color: #1a1616;
opacity: 0.7;
border-radius: 50%;
padding: 4px 20px !important;
background-color: #ffffff;
font-size: 29px;
}

button.owl-next {
position: absolute;
top: 50%;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
right: 30px;
}

button.owl-prev {
position: absolute;
top: 50%;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
left: 30px;
}

/***************** Best Of Place Page End *******************/
.pageHeader_btm .btm_logo img {
max-height: 50px;
}

.pageHeader_btm .menuBar li .menuLink {
font-size: 12px;
}

.ts-site-info {
padding: 20px 0;
text-align: center;
background-color: #444444;
color: #fff;
}

.ts-site-info-text {
margin-bottom: 0;
}

.header-mail-link {
color: #fff;
}

.login_button {
color: white !important;
text-decoration: none;
font-size: 14px;
padding: 8px 15px;
background-color: var(--main-bg-color);
}

.foot-social ul {
padding: 0px;
}

.foot-social ul li {
list-style-type: none !important;
float: left;
padding-right: 10px;
}

.foot-social ul li i {
font-size: 16px;
width: 32px;
height: 32px;
border: 1px solid #2d2d2d;
border-radius: 50px;
padding: 6px;
text-align: center;
/* background: #1aa5d8;
*/
color: #696969;
}

.ts-page-breadcrum {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
color: #fff;
}

.ts-page-breadcrum a {
color: #f68c34;
padding: 0 5px;
}

.nav-pills .nav-item {
margin-right: 5px;
margin-bottom: 5px;
}

.menuLink:hover {
color: #ed710a !important;
}

/***************** Service Page Start *******************/
.ts-service-card {
background-color: #fff;
padding: 20px;
text-align: center;
border-radius: 5px;
-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
}

.ts-service-card:hover {
-webkit-box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.ts-service-icon__inner {
width: 50px;
height: 50px;
margin: auto;
background-color: var(--main-primary-color);
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
padding: 10px;
font-size: 24px;
color: #fff;
border-radius: 50%;
margin-bottom: 20px;
}

h4.ts-service-title {
font-size: 20px;
line-height: 31px;
margin-bottom: 10px;
color: #444444;
}

.ts-enquiry-form {
padding: 40px;
background-color: #fff;
border-radius: 10px;
}

.light-gallery-list {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
}

.light-gallery-item {
padding: 0 12px;
margin-bottom: 20px;
width: 25%;
display: block;
overflow: hidden;
}

.light-gallery-item img {
-o-object-fit: cover;
object-fit: cover;
-o-object-position: center;
object-position: center;
border-radius: 5px;
-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
-webkit-transition: all ease-in-out 0.3s;
-o-transition: all ease-in-out 0.3s;
transition: all ease-in-out 0.3s;
width: 100% !important;
display: block;
}

.light-gallery-item:hover img {
-webkit-transform: scale(1.2);
-ms-transform: scale(1.2);
transform: scale(1.2);
}

/***************** Service Page End *******************/

/********************** Top Header Start ****************/
.c-pageHeaderTop .pageHeader_top .header-mail-link,
.c-pageHeaderTop .pageHeader_top .staticText,
.c-pageHeaderTop .pageHeader_top .staticLink {
font-size: 14px;
}

.c-select2DD.st-clear
.select2-container--default
.select2-selection--single
.select2-selection__rendered {
font-size: 14px;
min-width: 100px;
text-align: left;
}

.main-menu ul {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: baseline;
-ms-flex-align: baseline;
align-items: baseline;
}

.top-header .main-menu > ul > li > a {
font-size: 14px;
color: #555555;
font-weight: 500;
}

.top-header .header-btn .header-offer-btn {
display: block;
background: -webkit-gradient(
linear,
left top,
right top,
from(#fbdb24),
to(#ff5300)
);
background: -o-linear-gradient(left, #fbdb24, #ff5300);
background: var(--main-bg-color);
font-size: 15px;
font-weight: 500;
text-transform: capitalize;
line-height: 15px;
color: #fff;
padding: 12px 25px;
margin-left: 10px;
outline: none;
text-decoration: none;
border-radius: 20px;
}

.header-btn-cta {
display: block;
background: -webkit-gradient(
linear,
left top,
right top,
from(#fbdb24),
to(#ff5300)
);
background: -o-linear-gradient(left, #fbdb24, #ff5300);
background: var(--main-bg-color);
font-size: 15px;
font-weight: 500;
text-transform: capitalize;
line-height: 15px;
color: #fff;
padding: 12px 40px;
outline: none;
text-decoration: none;
border-radius: 20px;
width: 30%;
}

.header-btn-cta:hover {
background: #444444 !important;
color: #ffffff;
-webkit-box-shadow: none !important;
box-shadow: none !important;
}

.header-offer-btn:hover{
background: #444444 !important;
}

.header-offer-btn .btn:hover {
-webkit-box-shadow: none;
box-shadow: none;
}

.c-pageWrapper {
position: sticky;
top: 0;
z-index: 110;
background-color: white;
}

section.dataContainer {
position: absolute;
top: 50%;
left: 50%;
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
z-index: 1;
background-color: transparent;
width: 100%;
}

.search-tab-content {
padding: 24px 15px;
background-color: rgba(255, 255, 255, 1);
-webkit-backdrop-filter: blur(5px);
backdrop-filter: blur(5px);
}

.top-header {
padding: 15px 0;
}

.top-header .main-menu > ul > li > a .icon {
left: 3px;
}

ul.c-search-tabs .nav-link {
font-size: 13px;
}

.search-tab-content .m20-top {
margin-top: 5px !important;
}

.search-tab-content div[data-service="Activities"] .m26-top,
.search-tab-content div[data-service="Transfer"] .m26-top,
.search-tab-content div[data-service="Hotels"] .m20-top {
margin-top: 15px !important;
}

.ts-best-place-slider {
padding: 15px;
background-color: #ffffff;
border-radius: 10px;
}

.ts-hotel-listing-accordion .btn {
-webkit-box-shadow: none;
box-shadow: none;
border-radius: 0;
}

.ts-pageTitleSect {
padding: 40px 0;
}

.c-modifyFilter .btn {
-webkit-box-shadow: none;
box-shadow: none;
border-radius: 0;
}

.paginationjs {
padding: 20px 0;
}

.ts-video-title {
font-size: 14px;
color: #000;
margin-bottom: 10px;
padding-bottom: 10px;
border-bottom: 1px solid #ddd;
}
/********************** Top Hea\der End ****************/

.tab-pane .custom_texteditor ol {
padding-left: 40px;
margin-left: 0 !important;
}
.cardList-info .dividerSection.noborder {
margin: 0;
padding: 0;
border: 0;
margin-top: -10px;
}
.cardList-info .dividerSection .divider.s1 {
padding-top: 30px;
margin-top: -20px !important;
z-index: 10;
position: relative;
}
/***************** Responsive Start *******************/
@media (max-width: 1024px) {
.c-cardListTable .cardList-info .expandSect {
position: static;
margin-left: 5px;
display: inline-block;
}
}
@media (max-width: 991px) {
.ts-blog-content .ts-blog-card-img img {
height: 230px;
}

.ts-map-section iframe {
height: 300px;
}

.ts-reason-card {
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-ms-flex-direction: column;
flex-direction: column;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
text-align: center;
}

.ts-reason-card-icon {
margin-right: 0;
margin-bottom: 20px;
}

.ts-inner-landing-section img {
min-height: 200px;
width: 100%;
-o-object-fit: cover;
object-fit: cover;
-o-object-position: center;
object-position: center;
}

.ts-blog-content .ts-blog-card-description {
max-height: 170px;
overflow: hidden;
}

.ts-single-blog-content .ts-blog-card-description {
max-height: unset;
}

.light-gallery-item {
width: 33.33%;
}

.c-mainSlider .owl-stage-outer img {
min-height: 420px;
}

.ts-rate-section {
background-position: -720px center;
}

.ts-update-section button.owl-prev,
.ts-testimonial-section button.owl-prev {
left: -25px;
}

.ts-update-section button.owl-next,
.ts-testimonial-section button.owl-next {
left: unset;
right: -25px;
}

.c-footer h2 {
max-width: 100%;
}

.top-header .cmn-toggle-switch span {
background: #000;
}

.cmn-toggle-switch {
position: static;
}

.cmn-toggle-switch span {
position: static;
margin-top: 25px;
}

.top-header .cmn-toggle-switch span::before,
.top-header .cmn-toggle-switch span::after {
background-color: #000;
position: static;
margin: 6px 0;
}

.top-header .cmn-toggle-switch span::before {
margin-top: -7px;
}

.main-menu ul {
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-ms-flex-direction: column;
flex-direction: column;
}

.slider-container {
// max-width: 100%;
max-width: calc(100% - 5px);
}

.m15-top {
margin-top: 15px;
}

.search-tab-content div[data-service="Hotels"] .m20-top {
margin-top: 5px !important;
}

.main-menu a#close_in {
margin-right: 10px;
margin-top: 5px;
font-size: 20px;
right: 25px;
top: 25px;
display: block;
position: absolute;
}

.main-menu #header_menu {
text-align: left;
}

.c-pageHeaderTop {
position: static;
height: auto;
width: 100%;
}

.closeSidebar.forMobile {
display: none !important;
}

.main-menu .submenu:hover > ul {
display: block;
padding: 0;
visibility: visible;
-webkit-transform: translateY(0);
-ms-transform: translateY(0);
transform: translateY(0);
opacity: 1;
}

.show-submenu {
text-align: left;
}
.third-level ul {
display: none;
}
.third-level a {
text-align: left;
position: relative;
}
.third-level > a:after {
content: "\64";
font-family: "itours" !important;
font-style: normal !important;
font-weight: normal !important;
font-variant: normal !important;
text-transform: none !important;
speak: none;
line-height: 1;
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
margin-left: 10px;
}
.third-level:hover > ul {
display: block;
}
#header_menu img {
width: auto;
}
}

@media (max-width: 767px) {
.ts-who-are-section {
padding: 50px 0;
}

.ts-section-title {
font-size: 26px;
line-height: 40px;
}

.ts-section-subtitle-icon::before {
width: 35px;
}

.ts-section-subtitle-icon {
margin-left: 45px;
}

.ts-vision-card {
margin-bottom: 30px;
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-ms-flex-direction: column;
flex-direction: column;
text-align: center;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}

.ts-vision-card-icon {
margin-bottom: 20px;
}

.ts-adventure-section {
padding: 50px 0;
}

.ts-adventure-section .ta-section-title {
line-height: 36px;
font-size: 24px;
}

.ts-destinations-section {
padding: 50px 0;
}

.ts-destinations-section .ts-section-title {
margin-bottom: 20px;
}

.ts-rate-section {
padding: 50px 0;
}

.ts-available-rate-item {
padding: 0 5px;
}

.ts-available-rate-icon {
width: 80px;
height: 80px;
}

.ts-available-rate-icon img {
width: 30px;
height: 30px;
}

.ts-available-rate-title {
font-size: 14px;
}

.ts-testimonial-section {
padding: 50px 0;
}

.ts-testimonial-section .ts-section-title {
margin-bottom: 20px;
}

.ts-testimonial-img {
margin-bottom: 50px;
}

.ts-testimonial-slider .owl-nav {
top: calc(50% + 15px);
}

.ts-update-section {
padding: 50px 0;
}

.ts-update-section .ts-section-title {
margin-bottom: 20px;
}

.ts-update-info-item {
width: 50%;
}

.ts-update-info-item:not(:last-child) {
margin-right: 0;
}

.ts-contact-section {
padding: 50px 0;
}

.ts-contact-section .ts-section-title {
margin-bottom: 20px;
}

.ts-contact-info-list {
margin-bottom: 30px;
}

.ts-reason-section {
padding: 50px 0;
}

.ts-special-img img {
min-height: 220px;
}

.ts-special-content {
padding: 20px 15px;
}

.ts-special-content .ts-section-title {
font-size: 22px;
margin-bottom: 5px;
line-height: 1.5;
}

.ts-customer-testimonial-section {
padding: 50px 0;
}

.ts-blog-card-body {
padding: 20px;
}

.c-mainSlider .owl-item img {
width: 100%;
-o-object-fit: cover;
object-fit: cover;
-o-object-position: center;
object-position: center;
min-height: 200px;
height: 200px;
}

.c-footerLink {
margin-bottom: 25px;
margin-left: 20px;
}

.ts-best-place-section .ts-blog-info {
margin-top: 0;
}

.ts-best-place-landing-section .ts-section-title {
margin-bottom: 30px;
}

.ts-best-place-price-body {
padding: 15px 10px;
}

.nav-pills .nav-item {
margin-bottom: 5px;
margin-right: 5px;
}

.light-gallery-item {
width: 50%;
}

// .pageHeader_top>.container>.row>*:nth-child(1),
// .pageHeader_top>.container>.row>*:nth-child(2) {
// width: 50% !important;
// max-width: 50% !important;
// }

.c-pageHeaderTop .pageHeader_top .topListing ul {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: horizontal;
-webkit-box-direction: reverse;
-ms-flex-direction: row-reverse;
flex-direction: row-reverse;
-webkit-box-pack: justify;
-ms-flex-pack: justify;
justify-content: space-between;
}

.c-pageHeaderTop .pageHeader_top .topListing ul li {
width: auto;
}

.ts-update-section button.owl-prev,
.ts-testimonial-section button.owl-prev {
left: -15px;
width: 12px;
}

.ts-update-section button.owl-next,
.ts-testimonial-section button.owl-next {
left: unset;
right: -15px;
width: 12px;
}

.c-pageTitleSect {
text-align: left;
padding-top: 50px;
}
.c-breadcrumbs {
text-align: right;
margin-top: 20px;
}
.c-breadcrumbs ul {
float: unset;
}

.ts-enquiry-form button[type="submit"] {
display: block;
width: 100% !important;
margin-bottom: 10px;
}

.ts-enquiry-form {
padding: 20px;
}

.modal-content {
margin-bottom: 130px;
}

body .nav-pills .nav-item {
margin-bottom: 5px !important;
}

.alert.c-alert {
max-width: 100%;
margin-left: -50%;
}
section.dataContainer {
position: static;
transform: unset;
}
.c-cardListTable .cardList-info .expandSect {
display: block;
width: 60%;
left: 0;
position: static;
margin: 25px 4px;
}
.c-compTabs .nav-tabs .nav-item {
min-width: max-content;
}
.header-mail-link {
margin-bottom: 5px;
width: 50%;
display: inline-block !important;
text-align: right;
}
}

/***************** Responsive End *******************/
/************************* Style By Harshad Ambaliya End ***********************/

.div-upload {
padding: 4px 13px 4px 17px;
background: #fff;
color: var(--main-bg-color);
display: inline-block;
position: relative;
font-size: 12px;
line-height: 24px;
border-radius: 25px;
border: 1px solid var(--main-bg-color);
cursor: pointer;
-webkit-box-shadow: none;
box-shadow: none;
-webkit-transition: 0.5s;
-o-transition: 0.5s;
transition: 0.5s;
font-weight: 500;
}

.div-upload:hover {
background: #fdb714;
color: #fff;
}

.div-upload:hover:after {
background: #fff;
}

.div-upload ul {
margin: 0 !important;
}

.div-upload span.btn-text {
padding: 0px 15px 0px 40px;
}

.paginationjs {
text-align: center !important;
}

.paginationjs-pages {
margin: 0 auto;
display: inline-block;
float: none !important;
}

// New Header CSS
.header-logo {
padding: 10px 0;

img {
display: block;
max-height: 60px;
}
}

.sticky {
.header-logo {
padding: 0;
}
}

/*-------- 1.4 menu --------*/
.main-menu {
position: relative;
z-index: 9;
width: auto;
}

.main-menu a {
-webkit-transition: all 0.3s;
-o-transition: all 0.3s;
transition: all 0.3s;
}

.main-menu ul,
.main-menu ul li,
.main-menu ul li a {
position: relative;
margin-bottom: 0;
margin: 0;
padding: 0;
cursor: pointer;
}

/* Submenu styles */
.main-menu ul li a {
display: block;
line-height: 20px;
padding: 10px;
}

/*First level styles */
.main-menu > ul > li > a {
color: #0a0a0a;
padding: 0 10px 15px;
font-size: 16px;
font-weight: 600;

.icon {
display: inline-block;
font-size: 13px;
position: relative;
top: 2px;
left: -2px;
}
}

.sticky .main-menu > ul > li > a {
color: #333;
}

.sticky .main-menu > ul > li:hover > a {
color: @primary-color;
}

/*First level styles header plain */
header#plain .main-menu > ul > li > a {
color: #333;
}

header#plain .main-menu > ul > li:hover > a {
color: @primary-color;
}

/*First level styles header colored */
header#colored.sticky .main-menu > ul > li > a {
color: @white;
}

/* Opacity mask when left open */
.layer {
position: fixed;
top: 0;
left: 0;
width: 100%;
min-width: 100%;
z-index: 100;
min-height: 100%;
background-color: @black;
z-index: 99;
background-color: rgba(0, 0, 0, 0.8);
-webkit-transition: transform 0.3s ease 0s, opacity 0.3s ease 0s,
visibility 0s ease 0.3s;
-o-transition: transform 0.3s ease 0s, opacity 0.3s ease 0s,
visibility 0s ease 0.3s;
-webkit-transition: opacity 0.3s ease 0s, visibility 0s ease 0.3s,
-webkit-transform 0.3s ease 0s;
transition: opacity 0.3s ease 0s, visibility 0s ease 0.3s,
-webkit-transform 0.3s ease 0s;
transition: transform 0.3s ease 0s, opacity 0.3s ease 0s,
visibility 0s ease 0.3s;
transition: transform 0.3s ease 0s, opacity 0.3s ease 0s,
visibility 0s ease 0.3s, -webkit-transform 0.3s ease 0s;
opacity: 0;
visibility: hidden;
}

.layer-is-visible {
opacity: 1;
visibility: visible;
-webkit-transition: opacity 0.3s ease 0s, transform 0.3s ease 0s;
-o-transition: opacity 0.3s ease 0s, transform 0.3s ease 0s;
-webkit-transition: opacity 0.3s ease 0s, -webkit-transform 0.3s ease 0s;
transition: opacity 0.3s ease 0s, -webkit-transform 0.3s ease 0s;
transition: opacity 0.3s ease 0s, transform 0.3s ease 0s;
transition: opacity 0.3s ease 0s, transform 0.3s ease 0s,
-webkit-transform 0.3s ease 0s;
}

#close_in,
#header_menu,
.cmn-toggle-switch {
display: none;
}

a.dropdown-toggle.icon-search {
display: inline-block;
}

/* All styles for screen size between 992px and 1200px
================================================== */
@media (min-width: 992px) and (max-width: 1200px) {
/*First level styles */
.main-menu > ul > li > a {
padding: 0 5px 15px 5px;
}
}

/* All styles for screen size over 992px
================================================== */
@media only screen and (min-width: 992px) {
.main-menu {
width: auto;
}

.main-menu a {
white-space: nowrap;
}

.main-menu ul li {
display: inline-block;
}

.main-menu ul li.submenu:hover > a:before,
.main-menu ul li.submenu:hover > a:after {
bottom: -20px;
opacity: 0;
cursor: pointer;
}

/* Submenu + megamenu*/
.main-menu ul ul,
.main-menu ul li .menu-wrapper {
position: absolute;
border-top: 2px solid @primary-color;
z-index: 1;
visibility: hidden;
left: 3px;
top: 100%;
margin: 0;
display: block;
padding: 0;
background: @white;
min-width: 210px;
-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
-webkit-transform: translateY(20px);
-ms-transform: translateY(20px);
transform: translateY(20px);
opacity: 0;
-webkit-transition: all 0.2s ease;
-o-transition: all 0.2s ease;
transition: all 0.2s ease;
border-radius: 0 0 5px 5px;
}

.main-menu ul li .menu-wrapper {
padding: 10px 15px !important;
-webkit-box-sizing: border-box;
box-sizing: border-box;
}

.main-menu ul li:hover > ul,
.main-menu ul li:hover .menu-wrapper {
padding: 0;
visibility: visible;
-webkit-transform: translateY(0);
-ms-transform: translateY(0);
transform: translateY(0);
opacity: 1;
}

.main-menu ul .menu-wrapper ul {
-webkit-box-shadow: none;
box-shadow: none;
border-top: none;
margin: 0;
position: static;
-webkit-transform: translateY(0);
-ms-transform: translateY(0);
transform: translateY(0);
}

.main-menu ul .menu-wrapper ul:before {
border: 0;
}

.main-menu ul ul li {
display: block;
height: auto;
padding: 0;
}

.main-menu ul ul li a {
font-size: 12px;
color: #555;
display: block;
font-weight: 500;
text-align: left !important;
}

.main-menu ul ul li:hover > a {
color: @primary-color;
padding-left: 15px;
}

/* Megamenu */
.main-menu ul li.megamenu {
position: static;
}

.main-menu ul li.megamenu .menu-wrapper {
width: 1115px;
left: auto;
right: 0;
padding: 10px 30px 15px 30px !important;
}

.main-menu ul li:hover.megamenu .menu-wrapper {
visibility: visible;
opacity: 1;
}

.main-menu ul li:hover.megamenu .menu-wrapper ul {
visibility: visible;
opacity: 1;
}

.main-menu ul .menu-wrapper h3 {
font-size: 13px;
text-transform: uppercase;
border-bottom: 2px solid #ededed;
padding-bottom: 10px;
margin-bottom: 0;
font-weight: 600;
}

/* Submenu 3rd level */
.main-menu ul ul ul {
position: absolute;
border-top: 0;
z-index: 1;
height: auto;
left: 100%;
top: 0;
margin: 0;
padding: 0;
background: @white;
min-width: 195px;
-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
border-radius: 5px;
}

.main-menu ul ul:before {
bottom: 100%;
left: 15%;
border: solid transparent;
content: " ";
height: 0;
width: 0;
position: absolute;
pointer-events: none;
border-bottom-color: @primary-color;
border-width: 7px;
margin-left: -7px;
}

.main-menu ul ul ul:before {
border-width: 0;
margin-left: 0;
}

.main-menu ul ul li.third-level > a:hover {
color: @primary-color;
padding-left: 18px;
opacity: 1;
}

.main-menu ul ul li.third-level > a:after {
font-family: "itours";
content: "\66";
float: right;
font-size: 16px;
font-size: 1rem;
margin-top: -1px;
}
}

@media only screen and (max-width: 991px) {
#header_menu {
text-align: center;
padding: 25px 15px 10px 15px;
position: relative;
display: block;
}

.main-menu ul li a:hover,
a.show-submenu:hover,
a.show-submenu:focus,
a.show-submenu-mega:hover,
a.show-submenu-mega:focus {
color: @primary-color !important;
background-color: #f9f9f9;
}

.main-menu ul li {
border-top: none;
border-bottom: 1px solid #ededed;
color: #0a0a0a;
}

/* Menu mobile first level */
.main-menu ul li a {
padding: 10px 15px !important;
}

.main-menu h3 {
font-size: 12px;
line-height: 14px;
margin: 0;
padding: 0 0 15px 15px;
color: #333;
text-transform: uppercase;
}

.megamenu .menu-wrapper > div {
padding: 0;
}

.main-menu li,
.main-menu a {
display: block;
color: #333 !important;
}

.main-menu li {
position: relative;
}

.main-menu a:hover {
color: @primary-color !important;
}

.main-menu ul > li {
padding-bottom: 0;
}

.main-menu ul > li i {
float: right;
font-size: 16px;
}

/* Menu mobile second level */
.main-menu ul li.submenu ul {
font-size: 12px;
border-left: 1px solid #ededed;
margin: 0 0 15px 25px;
}

.main-menu ul li.submenu ul li {
font-size: 12px;
border: 0;
}

/* Menu mobile 3rd level */
.main-menu ul li.submenu ul ul {
margin: 0 0 0 25px;
}

/* Menu mobile left panel */
.main-menu {
overflow: auto;
-webkit-transform: translateX(-105%);
-ms-transform: translateX(-105%);
transform: translateX(-105%);
top: 0;
left: 0;
bottom: 0;
width: 55%;
height: 100%;
position: fixed;
background-color: @white;
z-index: 999999;
-webkit-box-shadow: 1px 0px 5px 0px rgba(50, 50, 50, 0.55);
box-shadow: 1px 0px 5px 0px rgba(50, 50, 50, 0.55);
-webkit-transition: all 0.5s cubic-bezier(0.77, 0, 0.175, 1);
-o-transition: all 0.5s cubic-bezier(0.77, 0, 0.175, 1);
transition: all 0.5s cubic-bezier(0.77, 0, 0.175, 1);
}

.main-menu.show {
-webkit-transform: translateX(0);
-ms-transform: translateX(0);
transform: translateX(0);
}

.main-menu .show-submenu + ul,
a.show-submenu-mega + .menu-wrapper {
display: none;
visibility: hidden;
}

a.show-submenu-mega + .menu-wrapper.show_mega,
.main-menu a.show-submenu + ul.show_normal {
display: block;
visibility: visible;
}

/* Hamburger menu button*/
.cmn-toggle-switch {
position: relative;
display: block;
overflow: visible;
position: absolute;
top: 0;
right: 20px;
margin: 0;
padding: 0;
width: 30px;
height: 30px;
font-size: 0;
text-indent: -9999px;
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
-webkit-box-shadow: none;
box-shadow: none;
border: none;
cursor: pointer;
}

.cmn-toggle-switch:focus {
outline: none;
}

.cmn-toggle-switch span {
display: block;
position: absolute;
top: 10px;
left: 0;
right: 0;
height: 2px;
background: white;
}

.cmn-toggle-switch span::before,
.cmn-toggle-switch span::after {
position: absolute;
display: block;
left: 0;
width: 100%;
height: 2px;
background-color: @white;
content: "";
}

.sticky .cmn-toggle-switch span::before,
.sticky .cmn-toggle-switch span::after,
.sticky .cmn-toggle-switch span {
background-color: #333;
}

/* Header plain */
header#plain .cmn-toggle-switch span::before,
header#plain .cmn-toggle-switch span::after,
header#plain .cmn-toggle-switch span,
header#plain.sticky .cmn-toggle-switch span::before,
header#plain.sticky .cmn-toggle-switch span::after {
background-color: #333;
}

/* Header transparent colored */
header#colored.sticky .cmn-toggle-switch span::before,
header#colored.sticky .cmn-toggle-switch span::after,
header#colored.sticky .cmn-toggle-switch span {
background-color: @white;
}

.cmn-toggle-switch span::before {
top: -10px;
}

.cmn-toggle-switch span::after {
bottom: -10px;
}

.cmn-toggle-switch__htx span::before,
.cmn-toggle-switch__htx span::after {
-webkit-transition-duration: 0.3s, 0.3s;
-o-transition-duration: 0.3s, 0.3s;
transition-duration: 0.3s, 0.3s;
-webkit-transition-delay: 0.3s, 0;
-o-transition-delay: 0.3s, 0;
transition-delay: 0.3s, 0;
}

.cmn-toggle-switch__htx span::before {
-webkit-transition-property: top, -webkit-transform;
transition-property: top, -webkit-transform;
-o-transition-property: top, transform;
transition-property: top, transform;
transition-property: top, transform, -webkit-transform;
}

.cmn-toggle-switch__htx span::after {
-webkit-transition-property: bottom, -webkit-transform;
transition-property: bottom, -webkit-transform;
-o-transition-property: bottom, transform;
transition-property: bottom, transform;
transition-property: bottom, transform, -webkit-transform;
}

/* active state, i.e. menu open */
.cmn-toggle-switch__htx.active span {
background: none !important;
}

.cmn-toggle-switch__htx.active span::before {
top: 0;
-webkit-transform: rotate(45deg);
-ms-transform: rotate(45deg);
transform: rotate(45deg);
}

.cmn-toggle-switch__htx.active span::after {
bottom: 0;
-webkit-transform: rotate(-45deg);
-ms-transform: rotate(-45deg);
transform: rotate(-45deg);
}

.cmn-toggle-switch__htx.active span::before,
.cmn-toggle-switch__htx.active span::after {
-webkit-transition-delay: 0, 0.3s;
-o-transition-delay: 0, 0.3s;
transition-delay: 0, 0.3s;
}
}

@media only screen and (max-width: 480px) {
.main-menu {
width: 100%;
}

a#close_in {
display: block;
position: absolute;
right: 15px;
top: 10px;
width: 20px;
height: 20px;
}

#close_in i {
color: #555 !important;
font-size: 16px;
}
}

.w-33 {
width: 33% !important;
}

.custom_texteditor,
.custom_texteditor * {
color: #454242;
font-size: 13px;
text-align: justify;
}

.custom_texteditor > span,
.custom_texteditor ul li > span {
font-size: 16px !important;
line-height: 22px !important;
color: #333 !important;
margin-bottom: 7px !important;
}

.custom_texteditor b {
display: inline-block !important;
font-weight: 700 !important;
}

.custom_texteditor ul,
.custom_texteditor ol {
margin-left: 25px !important;
}

.custom_texteditor ol {
list-style: decimal;
}

.custom_texteditor ul li {
margin-bottom: 10px !important;
list-style-type: disc !important;
margin-left: 20px !important;
}

.custom_texteditor ul li > span {
margin-bottom: 0 !important;
}

.c-alert {
width: 600px;
position: fixed;
top: 50%;
z-index: 1060;
left: 50%;
margin-left: -300px;
padding: 20px;
font-size: 15px;
}

.c-alert.alert-dismissible .close {
padding: 18px 6px;
outline: none !important;
}

.c-containerDark {
background-color: #f9f9f9;
padding: 50px 0;
}

.c-cardListTable.type-2 .cardList-info::before {
font-family: "itours";
content: "\26";
position: absolute;
font-size: 24px;
top: 3px;
left: 3px;
color: #d6d6d6;
line-height: 24px;
-o-transition: all ease 0.3s;
transition: all ease 0.3s;
-moz-transition: all ease 0.3s;
-webkit-transition: all ease 0.3s;
}

.c-compTabs .nav-tabs .nav-item {
display: inline-block;
margin: 2px 2px 0 0;
}
.c-cardList .priceTag .price_main .p_currency,
.c-cardList .priceTag .price_main .p_cost,
.infoCard .infoCard_price .p_currency,
.infoCard .infoCard_price .p_cost {
display: inline-block;
margin-top: 20px !important;
}
@media only screen and (max-width: 991px){
.top-header .header-btn .header-offer-btn{
margin-bottom: 15px;
}
}