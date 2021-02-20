<?php header("Content-type: text/css;"); ?>

@import url("https://fonts.googleapis.com/css?family=Quicksand");

/* Reset and default styles */

:root {
--primary-color: #4400aa;
--dark-color: #111;
--light-color: #eee;
--dark-grey: #404040;
--medium-grey: #808080;
--light-grey: #c0c0c0;
}

* {
box-sizing: border-box;
margin: 0px;
padding: 0;
}

body {
font-family: "Quicksand", Arial, Helvetica, sans-serif;
--webkit-font-smoothing: antialiased;
background: var(--dark-color);
color: var(--light-color);
}

ul {
list-style: none;
}

h1,
h2,
h3,
h4 {
color: var(--light-color);
}

a {
color: var(--light-color);
text-decoration: none;
}

p {
margin: 0.5rem 0;
}

img {
width: 100%;
}

/* showcase area */

.showcase {
width: 100%;
height: 100vh;
position: relative;
/* background: url("../images/background.jpg") no-repeat center center/cover; */
background-repeat: no-repeat;
background-position: center center;
background-size: cover;
}

.showcase-films {
height: 75vh;
}

.showcase::after {
content: "";
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 1;
background: rgba(0, 0, 0, 0.5);
box-shadow: inset 5rem 5rem 15rem #000, inset -5rem -5rem 15rem #000;
}

.showcase-top {
position: relative;
z-index: 2;
height: 128px;
}

.showcase-top img {
width: 256px;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
}

.logo2 {
display: none;
}

.showcase-top .topBtn {
position: absolute;
top: 50%;
right: 0%;
transform: translate(-2rem, -50%);
}

.showcase-content {
position: relative;
z-index: 2;
margin: auto;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
text-align: center;
margin-top: 7rem;
}

.register {
margin-top: 2rem;
}

.showcase-content h1 {
font-weight: 700;
font-size: 3rem;
line-height: 3rem;
margin-bottom: 2rem;
}

.showcase-content p {
text-transform: uppercase;
color: var(--light-color);
font-weight: 400;
font-size: 1.5rem;
line-height: 1.1;
margin-bottom: 2rem;
}

/* Tabs */
.tabs {
background: var(--dark-color);
padding-top: 1rem;
border-bottom: 3px solid var(--dark-grey);
}

.tab-content {
padding: 3rem 0;
}

#tab-1-content,
#tab-2-content {
display: none;
}

.show {
display: block !important;
}

.tabs .container {
display: grid;
grid-template-columns: repeat(2, 1fr);
grid-gap: 1rem;
align-items: center;
justify-content: center;
text-align: center;
}

.tabs p {
font-size: 1.1rem;
padding-top: 0.5rem;
}

.tabs .container > div {
color: var(--medium-grey);
padding: 1rem 0;
}

.tabs .container > div:hover {
color: var(--light-color);
cursor: pointer;
}

.tab-border {
border-bottom: var(--primary-color) 3px solid;
}

#tab-1-content .tab-1-content-grid {
display: grid;
grid-template-columns: repeat(2, 1fr);
grid-gap: 1.75rem;
align-items: center;
justify-content: center;
}

#tab-1-content img {
width: 100%;
border-radius: 5px;
}

#tab-2-content .tab-2-content-top {
display: grid;
grid-template-columns: 2fr 1fr;
grid-gap: 1rem;
justify-content: center;
align-items: center;
}

#tab-2-content .tab-2-content-bottom {
margin-top: 1.75rem;
display: grid;
grid-template-columns: repeat(3, 1fr);
grid-gap: 1.75rem;
justify-content: center;
text-align: center;
}

#tab-2-content i {
font-size: 10rem;
}

.footer {
margin: 1rem auto;
overflow: auto;
text-align: center;
background: var(--dark-grey);
padding: 1rem 0;
}

.footer a {
color: var(--light-gray);
font-size: 0.9rem;
}

.footer p {
margin-bottom: 1.25rem;
}

.footer img {
width: 64px;
}

/* Forms */

.sign-in {
width: 300px;
display: grid;
grid-template-columns: repeat(6, 1fr);
gap: 8px;
}

.sign-in label {
grid-column: 1 / 3;
justify-self: right;
}

.sign-in .input {
margin: 0;
padding: 0;
grid-column: 3 / 7;
justify-self: right;
width: 100%;
min-height: 3rem;
}

.sign-in .input input{
height: 2rem;
width: 100%;
}

.sign-in .input p {
margin: 0;
padding: 0 4px;
margin-top: 4px;
font-size: 0.75rem;
line-height: 1rem;
text-align: left;
color: #aa0000;
text-transform: none;
font-weight: bold;
}

.sign-in button {
grid-column: 2 / 6;
}

/* Sections */
.films-browse {
width: 100%;
}

.films-browse form {
margin: auto;
}

.navbar {
width: 100%;
background: var(--primary-color);
padding: 0.5rem;
margin: 2rem 0;
}

.navbar ul {
display: flex;
justify-content: center;
}

.navbar a {
padding: 0.5rem;
}

.navbar a:hover{
background: var(--dark-grey);
}

/* Tables */
.table {
width: 80%;
margin: auto;
margin-top: 0rem;
}

.table thead th {
text-transform: uppercase;
padding: 0.25rem;
}

.table tbody tr td {
padding: 0.25rem;
}

.table .basket {
text-align: center;
}

.table tbody tr:nth-child(odd) {
background: var(--dark-grey);
}

.table tbody tr:nth-child(even) {
background: var(--primary-color);
}

.films-purchase .table tbody tr:nth-child(even) {
background: #aa0000;
}

.films-purchase .last {
background: var(--primary-color);
}

/* Utilty classes */
.alert-green {
border: 0px;
border-radius: 4px;
padding: 4px;
background: #bfffbf;
color: #004000;
margin-bottom: 1rem;
}

input {
font-family: "Quicksand", Arial, Helvetica, sans-serif;
font-size: 0.8rem;
font-weight: bold;
padding: 4px;
border: 0px;
border-radius: 4px;
}

.error-input {
background-color: #ffe4e4;
color: #400000;
}

.error-message {
background-color: rgba(0, 0, 0, 0.5);
}

.container {
max-width: 75%;
margin: auto;
overflow: hidden;
padding: 0 2rem;
}

.text-xl {
font-size: 2rem;
margin-bottom: 1.2rem;
}

.text-lg {
font-size: 1.6rem;
margin-bottom: 1rem;
}

.text-md {
font-size: 1.2rem;
margin-bottom: 0.8rem;
}

.text-sm {
font-size: 0.8rem;
margin-bottom: 0.6rem;
}

.text-xs {
font-size: 0.7rem;
font-weight: bold;
margin-bottom: 0.55rem;
}

.text-center {
text-align: center;
}

.text-light-color {
color: var(--light-color);
}

.btn {
display: inline-block;
background: var(--primary-color);
color: #eee;
font-family: "Quicksand", Arial, Helvetica, sans-serif;
padding: 0.4rem 1.3rem;
font-size: 1rem;
text-align: center;
border: none;
cursor: pointer;
margin-right: 0.5rem;
outline: none;
box-shadow: 0 1px 0 rgba(0, 0, 0, 0.45);
border-radius: 2px;
}

.btn-remove {
background: #aa0000;
}

.btn:hover {
opacity: 0.9;
}

.btn-rounded {
border-radius: 5px;
}

.btn-xl {
font-size: 1.4rem;
padding: 1.1rem 1.8rem;
text-transform: uppercase;
}

.btn-lg {
font-size: 1rem;
padding: 0.8rem 1.3rem;
text-transform: uppercase;
}

.btn-md {
font-size: 0.8rem;
padding: 0.5rem 1rem;
text-transform: uppercase;
}

.btn-icon {
margin-left: 1rem;
}

/* Media queries */
@media (max-width: 960px) {
html,
body {
font-size: 10pt;
}

/* .showcase {
height: 90vh;
} */

.hide-sm {
display: none;
}

.showcase-top img {
top: 30%;
left: 5%;
transform: translate(0);
}
}

@media (max-width: 720px) {
.showcase-top img {
width: 192px;
}

#tab-1-content .tab-1-content-grid {
grid-template-columns: 1fr;
text-align: center;
}

#tab-2-content .tab-2-content-top {
display: block;
text-align: center;
}

#tab-2-content .tab-2-content-bottom {
grid-template-columns: 1fr;
}

.table {
width: 100%;
}
}

@media (max-width: 480px) {
.showcase-top img {
width: 96px;
}

.logo1 {
display: none;
}

.logo2 {
display: block;
}
}

@media (max-height: 480px) {
.showcase-content {
margin-top: 3.5rem;
}

.showcase-top {
height: 72px;
}
}