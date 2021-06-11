<!-- ご利用にあたってのためのコンポーネント -->
<style>
    .wrapper {
        width: 70%;
        margin: 0 auto;
    }

    .title {
        width: 100%;
        background-color: #FF8000;
        color: white;
    }

    .book {

        float: left;
        margin: auto 10px;
        padding-top: 5px;
    }

    .book svg {
        fill: white;
    }

    .wrapper {
        margin-bottom: 60px;
    }

    .explain p {
        padding-top: 2px;
    }
</style>
<div class="wrapper">

    <div class="title">
        <div class="book">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                <g>
                    <rect fill="none" height="24" width="24" />
                </g>
                <g>
                    <g>
                        <g>
                            <path d="M17.5,4.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65c0,0.65,0.73,0.45,0.75,0.45 C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5c1.65,0,3.35,0.3,4.75,1.05 C22.66,21.26,23,20.86,23,20.6V6C21.51,4.88,19.37,4.5,17.5,4.5z M21,18.5c-1.1-0.35-2.3-0.5-3.5-0.5c-1.7,0-4.15,0.65-5.5,1.5V8 c1.35-0.85,3.8-1.5,5.5-1.5c1.2,0,2.4,0.15,3.5,0.5V18.5z" />
                        </g>
                    </g>
                </g>
            </svg>
        </div>
        <div class="title-letter">
            <h2>{{$title}}</h2>
        </div>
    </div>
    <div class="explain">
        <p>{{$explain}}</p>
    </div>
</div>