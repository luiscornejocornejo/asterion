@include('pp.header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>
<style>
  * {
    box-sizing: border-box;
  }

  body {
    font-size: 14px;
  }

  .v825_34016 {
    width: 100%;
    height: 860px;
    background: rgba(199, 225, 228, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34017 {
    width: 584px;
    height: 788px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;

    top: 72px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    box-shadow: 0px 2px 4px rgba(0.007986098527908325, 0.163310244679451, 0.18368056416511536, 0.11999999731779099);
    overflow: hidden;
  }

  .v825_34018 {
    width: 584px;
    height: 200px;
    background: linear-gradient(rgba(255, 240, 220, 1), rgba(255, 255, 255, 0));
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34019 {
    width: 47px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 53px;
    left: 16px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34020 {
    width: 81px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 53px;
    left: 71px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34021 {
    width: 150px;
    height: 17px;
    background: url("../images/v825_34021.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 60px;
    left: 588px;
    overflow: hidden;
  }

  .v825_34022 {
    width: 150px;
    color: url("../images/v825_34022.png");
    position: absolute;
    top: 2472px;
    left: 0px;
    font-size: 14px;
    opacity: 1;
    text-align: right;
  }

  .v825_34023 {
    width: 115px;
    color: url("../images/v825_34023.png");
    position: absolute;
    top: 16px;
    left: 453px;
    font-size: 14px;
    opacity: 1;
    text-align: right;
  }

  .v825_34024 {
    width: 263px;
    height: 20px;
    background: url("../images/v825_34024.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 12px;
    opacity: 1;
    position: absolute;
    top: 14px;
    left: 16px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34026 {
    width: 231px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 2px;
    left: 32px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .v825_34029 {
    width: 552px;
    height: 79px;
    background: url("../images/v825_34029.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 94px;
    left: 16px;
    overflow: hidden;
  }

  .v825_34030 {
    width: 123px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 28px;
    left: 276px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34031 {
    width: 109px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 28px;
    left: 407px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34032 {
    width: 75px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 0px;
    left: 276px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34033 {
    width: 99px;
    color: rgba(166, 166, 166, 1);
    position: absolute;
    top: 0px;
    left: 359px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34034 {
    width: 104px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 56px;
    left: 276px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34035 {
    width: 109px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 56px;
    left: 388px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34036 {
    width: 98px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 28px;
    left: 0px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34037 {
    width: 111px;
    color: rgba(255, 147, 0, 1);
    position: absolute;
    top: 28px;
    left: 106px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34038 {
    width: 49px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 56px;
    left: 0px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34039 {
    width: 89px;
    height: 16px;
    background: url("../images/v825_34039.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 4px;
    opacity: 1;
    position: absolute;
    top: 56px;
    left: 57px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34041 {
    width: 69px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 0px;
    left: 20px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34042 {
    width: 49px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 0px;
    left: 0px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34043 {
    width: 94px;
    color: rgba(255, 147, 0, 1);
    position: absolute;
    top: 0px;
    left: 57px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .v825_34050 {
    width: 552px;
    height: 512px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 248px;
    left: 16px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1599999964237213);
    overflow: hidden;
  }

  .v825_34051 {
    width: 552px;
    height: 516px;
    background: rgba(234, 234, 234, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34052 {
    width: 552px;
    height: 48px;
    background: rgba(234, 234, 234, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34053 {
    width: 230px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 15px;
    left: 44px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .v825_34055 {
    width: 552px;
    height: 400px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 48px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34056 {
    width: 528px;
    height: 40px;
    background: url("../images/v825_34056.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 460px;
    left: 12px;
    overflow: hidden;
  }

  .v825_34057 {
    width: 476px;
    height: 40px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34058 {
    width: 24px;
    height: 24px;
    background: rgba(38, 38, 38, 1);
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 440px;
    overflow: hidden;
  }

  .v825_34059 {
    width: 24px;
    height: 24px;
    background: rgba(38, 38, 38, 1);
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 408px;
    overflow: hidden;
  }

  .v825_34060 {
    width: 40px;
    height: 40px;
    background: rgba(3, 64, 72, 1);
    padding: 8px 8px;
    margin: 10px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 488px;
    border-top-left-radius: 48px;
    border-top-right-radius: 48px;
    border-bottom-left-radius: 48px;
    border-bottom-right-radius: 48px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34062 {
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 10px;
    left: 10px;
    overflow: hidden;
  }

  .v825_34063 {
    width: 16px;
    height: 16px;
    background: url("../images/v825_34063.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 1px;
    left: 1px;
    overflow: hidden;
  }

  .v825_34064 {
    width: 16px;
    height: 16px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
  }

  .v825_34065 {
    width: 4px;
    height: 118px;
    background: rgba(196, 196, 196, 1);
    opacity: 1;
    position: absolute;
    top: 48px;
    left: 694px;
    overflow: hidden;
  }

  .v825_34066 {
    width: 99px;
    height: 12px;
    background: url("../images/v825_34066.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 18px;
    left: 440px;
    overflow: hidden;
  }

  .v825_34067 {
    width: 15px;
    height: 7px;
    background: url("../images/v825_34067.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 2px;
    left: 84px;
    overflow: hidden;
  }

  .v825_34068 {
    width: 6px;
    height: 7px;
    background: rgba(255, 147, 0, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
  }

  .v825_34069 {
    width: 7px;
    height: 6px;
    background: rgba(255, 147, 0, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 7px;
  }

  .v825_34070 {
    width: 83px;
    height: 12px;
    background: url("../images/v825_34070.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34071 {
    width: 10px;
    height: 12px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
  }

  .v825_34072 {
    width: 10px;
    height: 11px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 11px;
  }

  .v825_34073 {
    width: 11px;
    height: 11px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 23px;
  }

  .v825_34074 {
    width: 3px;
    height: 11px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 36px;
  }

  .v825_34075 {
    width: 11px;
    height: 12px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 40px;
  }

  .v825_34076 {
    width: 11px;
    height: 11px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 52px;
  }

  .v825_34077 {
    width: 10px;
    height: 11px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 63px;
  }

  .v825_34078 {
    width: 10px;
    height: 11px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 73px;
  }

  .v825_34079 {
    width: 730px;
    height: 42px;
    background: url("../images/v825_34079.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 12px;
    opacity: 1;
    position: absolute;
    top: 832px;
    left: 12px;
    overflow: hidden;
  }

  .v825_34080 {
    width: 730px;
    height: 42px;
    background: url("../images/v825_34080.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 8px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34081 {
    width: 552px;
    height: 35px;
    background: url("../images/v825_34081.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 197px;
    left: 16px;
    overflow: hidden;
  }

  .v825_34082 {
    width: 370px;
    height: 35px;
    background: url("../images/v825_34082.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 8px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34083 {
    width: 129px;
    height: 35px;
    background: url("../images/v825_34083.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34084 {
    width: 129px;
    height: 32px;
    background: url("../images/v825_34084.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    padding: 8px 16px;
    margin: 8px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34086 {
    width: 69px;
    color: rgba(3, 64, 72, 1);
    position: absolute;
    top: 8px;
    left: 40px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34087 {
    width: 129px;
    height: 3px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 32px;
    left: 0px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .v825_34088 {
    width: 119px;
    height: 35px;
    background: url("../images/v825_34088.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 137px;
    overflow: hidden;
  }

  .v825_34089 {
    width: 119px;
    height: 32px;
    background: url("../images/v825_34089.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    padding: 8px 16px;
    margin: 8px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34091 {
    width: 59px;
    color: rgba(170, 170, 170, 1);
    position: absolute;
    top: 8px;
    left: 40px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34092 {
    width: 119px;
    height: 3px;
    background: rgba(234, 234, 234, 1);
    opacity: 1;
    position: absolute;
    top: 32px;
    left: 0px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .v825_34093 {
    width: 106px;
    height: 35px;
    background: url("../images/v825_34093.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 264px;
    overflow: hidden;
  }

  .v825_34094 {
    width: 106px;
    height: 32px;
    background: url("../images/v825_34094.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    padding: 8px 16px;
    margin: 8px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34096 {
    width: 46px;
    color: rgba(170, 170, 170, 1);
    position: absolute;
    top: 8px;
    left: 40px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34097 {
    width: 106px;
    height: 3px;
    background: rgba(234, 234, 234, 1);
    opacity: 1;
    position: absolute;
    top: 32px;
    left: 0px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .v825_36779 {
    width: 339px;
    height: 32px;
    background: url("../images/v825_36779.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 45px;
    left: 229px;
    overflow: hidden;
  }

  .v825_36780 {
    width: 102px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    padding: 8px 8px;
    margin: 4px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .v825_36781 {
    width: 16px;
    height: 16px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 30px;
    overflow: hidden;
  }

  .v825_36782 {
    width: 9px;
    height: 12px;
    background: url("../images/v825_36782.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 2px;
    left: 2px;
    overflow: hidden;
  }

  .v825_36783 {
    width: 9px;
    height: 12px;
    background: url("../images/v825_36783.png");
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    border: 1.3333333730697632px solid rgba(38, 38, 38, 1);
  }

  .v825_36784 {
    width: 70px;
    height: 16px;
    background: url("../images/v825_36784.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 6px;
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 8px;
    overflow: hidden;
  }

  .v825_36785 {
    width: 16px;
    height: 16px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_36786 {
    width: 11px;
    height: 13px;
    background: url("../images/v825_36786.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 1px;
    left: 2px;
    overflow: hidden;
  }

  .v825_36787 {
    width: 11px;
    height: 13px;
    background: rgba(38, 38, 38, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    border: 0.30000001192092896px solid rgba(255, 255, 255, 1);
  }

  .v825_36788 {
    width: 48px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 0px;
    left: 22px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .v825_36790 {
    width: 105px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    padding: 8px 8px;
    margin: 4px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 102px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .v825_36791 {
    width: 73px;
    height: 16px;
    background: url("../images/v825_36791.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 6px;
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 8px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_36793 {
    width: 51px;
    color: rgba(0, 0, 0, 1);
    position: absolute;
    top: 0px;
    left: 22px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .v825_36795 {
    width: 100px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    padding: 8px 6px;
    margin: 6px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 207px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_36797 {
    width: 66px;
    color: rgba(0, 0, 0, 1);
    position: absolute;
    top: 8px;
    left: 28px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_36798 {
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    padding: 8px 8px;
    margin: 8px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 307px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_36800 {
    width: 57px;
    color: rgba(0, 0, 0, 1);
    position: absolute;
    top: 10px;
    left: 30px;
    font-family: Montserrat;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34116 {
    width: 250px;
    height: 40px;
    background: rgba(255, 240, 220, 1);
    opacity: 1;
    top: 0px;
    overflow: hidden;
  }

  .v825_34117 {
    width: 304px;
    height: 772px;
    background: url("../images/v825_34117.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 12px;
    opacity: 1;
    position: absolute;
    top: 72px;
    left: 989px;
    overflow: hidden;
  }

  .v825_34118 {
    width: 304px;
    height: 720px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    box-shadow: 0px 2px 4px rgba(0.007986098527908325, 0.163310244679451, 0.18368056416511536, 0.11999999731779099);
    overflow: hidden;
  }

  .v825_34119 {
    width: 304px;
    height: 40px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34120 {
    width: 250px;
    height: 52px;
    background: rgba(3, 64, 72, 1);
    opacity: 1;
    position: absolute;
    top: 234px;
    left: 54px;
    overflow: hidden;
  }

  .v825_34121 {
    width: 150px;
    color: rgba(255, 255, 255, 1);
    position: absolute;
    top: 12px;
    left: 16px;
    font-family: Work Sans;
    font-weight: SemiBold;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .v825_34123 {
    width: 62px;
    height: -1px;
    background: url("../images/v825_34123.png");
    opacity: 1;
    position: absolute;
    top: 84px;
    left: 28px;
    border: 2px solid rgba(227, 231, 240, 1);
  }

  .v825_34124 {
    width: 62px;
    height: -1px;
    background: url("../images/v825_34124.png");
    opacity: 1;
    position: absolute;
    top: 178px;
    left: 28px;
    border: 2px solid rgba(227, 231, 240, 1);
  }

  .v825_34125 {
    width: 62px;
    height: -1px;
    background: url("../images/v825_34125.png");
    opacity: 1;
    position: absolute;
    top: 272px;
    left: 28px;
    border: 2px solid rgba(227, 231, 240, 1);
  }

  .v825_34126 {
    width: 62px;
    height: -1px;
    background: url("../images/v825_34126.png");
    opacity: 1;
    position: absolute;
    top: 366px;
    left: 28px;
    border: 2px solid rgba(227, 231, 240, 1);
  }

  .v825_34127 {
    width: 62px;
    height: -1px;
    background: url("../images/v825_34127.png");
    opacity: 1;
    position: absolute;
    top: 460px;
    left: 28px;
    border: 2px solid rgba(227, 231, 240, 1);
  }

  .v825_34128 {
    width: 260px;
    height: 74px;
    background: url("../images/v825_34128.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 56px;
    left: 16px;
    overflow: hidden;
  }

  .v825_34129 {
    width: 83px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 20px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 12px;
    opacity: 1;
    text-align: left;
  }

  .v825_34130 {
    width: 224px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 42px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34131 {
    width: 133px;
    color: rgba(3, 64, 72, 1);
    position: absolute;
    top: 0px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34132 {
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 2px;
    left: 0px;
    border-top-left-radius: 57px;
    border-top-right-radius: 57px;
    border-bottom-left-radius: 57px;
    border-bottom-right-radius: 57px;
    box-shadow: 0px 2.4000000953674316px 4px rgba(0, 0, 0, 0.20000000298023224);
    overflow: hidden;
  }

  .v825_34133 {
    width: 19px;
    height: 19px;
    background: rgba(20, 150, 167, 1);
    opacity: 1;
    position: absolute;
    top: 2px;
    left: 2px;
  }

  .v825_34134 {
    width: 260px;
    height: 74px;
    background: url("../images/v825_34134.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 150px;
    left: 16px;
    overflow: hidden;
  }

  .v825_34135 {
    width: 83px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 20px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 12px;
    opacity: 1;
    text-align: left;
  }

  .v825_34136 {
    width: 224px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 42px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34137 {
    width: 133px;
    color: rgba(3, 64, 72, 1);
    position: absolute;
    top: 0px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34138 {
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34139 {
    width: 22px;
    height: 22px;
    background: rgba(20, 150, 167, 1);
    opacity: 1;
    position: absolute;
    top: 1px;
    left: 1px;
  }

  .v825_34140 {
    width: 260px;
    height: 74px;
    background: url("../images/v825_34140.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 338px;
    left: 16px;
    overflow: hidden;
  }

  .v825_34141 {
    width: 83px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 20px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 12px;
    opacity: 1;
    text-align: left;
  }

  .v825_34142 {
    width: 224px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 42px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34143 {
    width: 133px;
    color: rgba(3, 64, 72, 1);
    position: absolute;
    top: 0px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34144 {
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34145 {
    width: 20px;
    height: 20px;
    background: rgba(20, 150, 167, 1);
    opacity: 1;
    position: absolute;
    top: 2px;
    left: 2px;
  }

  .v825_34146 {
    width: 260px;
    height: 74px;
    background: url("../images/v825_34146.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 244px;
    left: 16px;
    overflow: hidden;
  }

  .v825_34147 {
    width: 83px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 20px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 12px;
    opacity: 1;
    text-align: left;
  }

  .v825_34148 {
    width: 224px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 42px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34149 {
    width: 133px;
    color: rgba(3, 64, 72, 1);
    position: absolute;
    top: 0px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34150 {
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34151 {
    width: 20px;
    height: 20px;
    background: rgba(20, 150, 167, 1);
    opacity: 1;
    position: absolute;
    top: 2px;
    left: 2px;
  }

  .v825_34152 {
    width: 260px;
    height: 74px;
    background: url("../images/v825_34152.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 432px;
    left: 16px;
    overflow: hidden;
  }

  .v825_34153 {
    width: 83px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 20px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 12px;
    opacity: 1;
    text-align: left;
  }

  .v825_34154 {
    width: 224px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 42px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34155 {
    width: 133px;
    color: rgba(3, 64, 72, 1);
    position: absolute;
    top: 0px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34156 {
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34157 {
    width: 21px;
    height: 21px;
    background: rgba(239, 68, 57, 1);
    opacity: 1;
    position: absolute;
    top: 1px;
    left: 1px;
  }

  .v825_34158 {
    width: 260px;
    height: 74px;
    background: url("../images/v825_34158.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 526px;
    left: 16px;
    overflow: hidden;
  }

  .v825_34159 {
    width: 83px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 20px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Light;
    font-size: 12px;
    opacity: 1;
    text-align: left;
  }

  .v825_34160 {
    width: 224px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 42px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34161 {
    width: 133px;
    color: rgba(3, 64, 72, 1);
    position: absolute;
    top: 0px;
    left: 36px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34162 {
    width: 24px;
    height: 24px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34163 {
    width: 20px;
    height: 19px;
    background: rgba(239, 68, 57, 1);
    opacity: 1;
    position: absolute;
    top: 2px;
    left: 2px;
  }

  .v825_34164 {
    width: 304px;
    height: 84px;
    background: linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
    opacity: 1;
    position: absolute;
    top: 636px;
    left: 0px;
    box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.20000000298023224);
    overflow: hidden;
  }

  .v825_34165 {
    width: 228px;
    height: 36px;
    background: url("../images/v825_34165.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    padding: 12px 12px;
    opacity: 1;
    position: absolute;
    top: 668px;
    left: 16px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .v825_34166 {
    width: 94px;
    color: rgba(156, 156, 156, 1);
    position: absolute;
    top: 10px;
    left: 12px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34167 {
    width: 36px;
    height: 36px;
    background: rgba(170, 170, 170, 1);
    padding: 8px 8px;
    margin: 10px;
    opacity: 1;
    position: absolute;
    top: 668px;
    left: 252px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34169 {
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 8px;
    overflow: hidden;
  }

  .v825_34170 {
    width: 16px;
    height: 16px;
    background: url("../images/v825_34170.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 1px;
    left: 1px;
    overflow: hidden;
  }

  .v825_34171 {
    width: 16px;
    height: 16px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
  }

  .v825_34172 {
    width: 4px;
    height: 68px;
    background: rgba(170, 170, 170, 1);
    opacity: 1;
    position: absolute;
    top: 52px;
    left: 300px;
    overflow: hidden;
  }

  .v825_34173 {
    width: 304px;
    height: 40px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 732px;
    left: 0px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    box-shadow: 0px 2px 4px rgba(0.007986098527908325, 0.163310244679451, 0.18368056416511536, 0.11999999731779099);
    overflow: hidden;
  }

  .v825_34174 {
    width: 304px;
    height: 40px;
    background: rgba(3, 64, 72, 1);
    padding: 12px 12px;
    margin: 50px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34175 {
    width: 214px;
    color: rgba(255, 255, 255, 1);
    position: absolute;
    top: 12px;
    left: 12px;
    font-family: Work Sans;
    font-weight: SemiBold;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .v825_34177 {
    width: 4px;
    height: 64px;
    background: rgba(82, 125, 130, 1);
    opacity: 1;
    position: absolute;
    top: 183px;
    left: 373px;
    overflow: hidden;
  }

  .v825_34178 {
    width: 356px;
    height: 788px;
    background: url("../images/v825_34178.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 1px;
    opacity: 1;
    top: 72px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    box-shadow: 0px 2px 4px rgba(0.007986098527908325, 0.163310244679451, 0.18368056416511536, 0.11999999731779099);
    overflow: hidden;
  }

  .v825_34179 {
    width: 356px;
    height: 44px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34180 {
    width: 165px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 14px;
    left: 12px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34181 {
    width: 113px;
    height: 32px;
    background: url("../images/v825_34181.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    padding: 8px 12px;
    margin: 4px;
    opacity: 1;
    position: absolute;
    top: 6px;
    left: 243px;
    overflow: hidden;
  }

  .v825_34182 {
    width: 75px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 8px;
    left: 12px;
    font-family: Work Sans;
    font-weight: Medium;
    font-size: 14px;
    opacity: 1;
    text-align: right;
  }

  .name {
    color: #fff;
  }

  .v825_34610 {
    width: 356px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 45px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34611 {
    width: 307px;
    height: 32px;
    background: url("../images/v825_34611.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34612 {
    width: 102px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    padding: 8px 8px;
    margin: 4px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .v825_34613 {
    width: 16px;
    height: 16px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 30px;
    overflow: hidden;
  }

  .v825_34614 {
    width: 9px;
    height: 12px;
    background: url("../images/v825_34614.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 2px;
    left: 2px;
    overflow: hidden;
  }

  .v825_34615 {
    width: 9px;
    height: 12px;
    background: url("../images/v825_34615.png");
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    border: 1.3333333730697632px solid rgba(38, 38, 38, 1);
  }

  .v825_34616 {
    width: 70px;
    height: 16px;
    background: url("../images/v825_34616.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 6px;
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 8px;
    overflow: hidden;
  }

  .v825_34617 {
    width: 16px;
    height: 16px;
    background: rgba(255, 255, 255, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
  }

  .v825_34618 {
    width: 11px;
    height: 13px;
    background: url("../images/v825_34618.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    opacity: 1;
    position: absolute;
    top: 1px;
    left: 2px;
    overflow: hidden;
  }

  .v825_34619 {
    width: 11px;
    height: 13px;
    background: rgba(38, 38, 38, 1);
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 0px;
    border: 0.30000001192092896px solid rgba(255, 255, 255, 1);
  }

  .v825_34620 {
    width: 48px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 0px;
    left: 22px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .v825_34622 {
    width: 105px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    padding: 8px 8px;
    margin: 4px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 102px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .v825_34623 {
    width: 73px;
    height: 16px;
    background: url("../images/v825_34623.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 6px;
    opacity: 1;
    position: absolute;
    top: 8px;
    left: 8px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34625 {
    width: 51px;
    color: rgba(0, 0, 0, 1);
    position: absolute;
    top: 0px;
    left: 22px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .name {
    color: #fff;
  }

  .v825_34627 {
    width: 100px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    padding: 8px 6px;
    margin: 6px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 207px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34629 {
    width: 66px;
    color: rgba(38, 38, 38, 1);
    position: absolute;
    top: 8px;
    left: 28px;
    font-family: Work Sans;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34630 {
    width: 32px;
    height: 32px;
    background: rgba(255, 255, 255, 1);
    padding: 8px 8px;
    margin: 8px;
    opacity: 1;
    position: absolute;
    top: 0px;
    left: 324px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .v825_34632 {
    width: 57px;
    color: rgba(0, 0, 0, 1);
    position: absolute;
    top: 10px;
    left: 30px;
    font-family: Montserrat;
    font-weight: Regular;
    font-size: 14px;
    opacity: 1;
    text-align: left;
  }

  .v825_34184 {
    width: 356px;
    height: 710px;
    background: url("../images/v825_34184.png");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    margin: 1px;
    opacity: 1;
    position: absolute;
    top: 78px;
    left: 0px;
    overflow: hidden;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }

  .name {
    color: #fff;
  }
</style>
<div id="principal" style="margin-top: 20px;">
  <div id="alert"></div>
  <div class="mx-auto" style="width: 1000px;">

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade
                            show" role="alert">
      {{ $message }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Begin Page Content -->
      <div class="page-content">
        <div class="container-fluid">
        <div class="d-lg-flex "  >
            <div class="v825_34017 chat-leftsidebar " style="margin-left: 20px;">
                <div class="v825_34018"></div><span class="v825_34019">Motivo:</span><span class="v825_34020">Sin
                    Servicio</span>
                <div class="v825_34021"><span class="v825_34022">Estado: Visita Tecnica</span></div><span
                    class="v825_34023">Ticket: #0427229</span>
                <div class="v825_34024">
                    <div class="name"></div><span class="v825_34026">Jhonatan Alejandro Garcia Molina</span>
                </div>
                <div class="name"></div>
                <div class="name"></div>
                <div class="v825_34029"><span class="v825_34030">Fecha de creación:</span><span class="v825_34031">04/12/21
                        • 12:00</span><span class="v825_34032">Asignado a:</span><span class="v825_34033">- Sin asignar
                        -</span><span class="v825_34034">Fecha de cierre:</span><span class="v825_34035">04/12/21 •
                        13:00</span><span class="v825_34036">Departamento:</span><span class="v825_34037">Soporte
                        Tecnico</span><span class="v825_34038">Fuente:</span>
                    <div class="v825_34039">
                        <div class="name"></div><span class="v825_34041">Whatsapp</span>
                    </div><span class="v825_34042">Estado:</span><span class="v825_34043">Visita Técnica</span>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                </div>
                <div class="v825_34050">
                    <div class="v825_34051"></div>
                    <div class="v825_34052"></div><span class="v825_34053">Jhonatan Alejandro Garcia Molina</span>
                    <div class="name"></div>
                    <div class="v825_34055"></div>
                    <div class="v825_34056">
                        <div class="v825_34057"></div>
                        <div class="v825_34058"></div>
                        <div class="v825_34059"></div>
                        <div class="v825_34060">
                            <div class="name"></div>
                            <div class="v825_34062">
                                <div class="v825_34063">
                                    <div class="v825_34064"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="v825_34065"></div>
                    <div class="v825_34066">
                        <div class="v825_34067">
                            <div class="v825_34068"></div>
                            <div class="v825_34069"></div>
                        </div>
                        <div class="v825_34070">
                            <div class="v825_34071"></div>
                            <div class="v825_34072"></div>
                            <div class="v825_34073"></div>
                            <div class="v825_34074"></div>
                            <div class="v825_34075"></div>
                            <div class="v825_34076"></div>
                            <div class="v825_34077"></div>
                            <div class="v825_34078"></div>
                        </div>
                    </div>
                </div>
                <div class="v825_34079">
                    <div class="v825_34080"></div>
                </div>
                <div class="v825_34081">
                    <div class="v825_34082">
                        <div class="v825_34083">
                            <div class="v825_34084">
                                <div class="name"></div><span class="v825_34086">Whatsapp</span>
                            </div>
                            <div class="v825_34087"></div>
                        </div>
                        <div class="v825_34088">
                            <div class="v825_34089">
                                <div class="name"></div><span class="v825_34091">Llamada</span>
                            </div>
                            <div class="v825_34092"></div>
                        </div>
                        <div class="v825_34093">
                            <div class="v825_34094">
                                <div class="name"></div><span class="v825_34096">Correo</span>
                            </div>
                            <div class="v825_34097"></div>
                        </div>
                    </div>
                </div>
                <div class="v825_36779">
                    <div class="v825_36780">
                        <div class="v825_36781">
                            <div class="v825_36782">
                                <div class="v825_36783"></div>
                            </div>
                        </div>
                        <div class="v825_36784">
                            <div class="v825_36785">
                                <div class="v825_36786">
                                    <div class="v825_36787"></div>
                                </div>
                            </div><span class="v825_36788">Estado</span>
                        </div>
                        <div class="name"></div>
                    </div>
                    <div class="v825_36790">
                        <div class="v825_36791">
                            <div class="name"></div><span class="v825_36793">Asignar</span>
                        </div>
                        <div class="name"></div>
                    </div>
                    <div class="v825_36795">
                        <div class="name"></div><span class="v825_36797">Transferir</span>
                    </div>
                    <div class="v825_36798">
                        <div class="name"></div><span class="v825_36800">Acción2</span>
                    </div>
                </div>
            </div>
            <div class="v825_34116 w-100 user-chat "></div>
            <div class="v825_34117">
                <div class="v825_34118">
                    <div class="v825_34119"></div>
                    <div class="v825_34120"></div><span class="v825_34121">Bitacora / #0427229 </span>
                    <div class="name"></div>
                    <div class="v825_34123"></div>
                    <div class="v825_34124"></div>
                    <div class="v825_34125"></div>
                    <div class="v825_34126"></div>
                    <div class="v825_34127"></div>
                    <div class="v825_34128"><span class="v825_34129">26/12/21 · 12:20</span><span
                            class="v825_34130">Asignación, lorem ipsum lorem ipsum lorem ipsum</span><span
                            class="v825_34131">Eduard Chavarriaga</span>
                        <div class="v825_34132">
                            <div class="v825_34133"></div>
                        </div>
                    </div>
                    <div class="v825_34134"><span class="v825_34135">26/12/21 · 12:20</span><span class="v825_34136">Cambio
                            de departamento, lorem ipsum lorem ipsum</span><span class="v825_34137">Eduard
                            Chavarriaga</span>
                        <div class="v825_34138">
                            <div class="v825_34139"></div>
                        </div>
                    </div>
                    <div class="v825_34140"><span class="v825_34141">26/12/21 · 12:20</span><span class="v825_34142">Cambio
                            de status ticket, lorem ipsum lorem ipsum</span><span class="v825_34143">Eduard
                            Chavarriaga</span>
                        <div class="v825_34144">
                            <div class="v825_34145"></div>
                        </div>
                    </div>
                    <div class="v825_34146"><span class="v825_34147">26/12/21 · 12:20</span><span class="v825_34148">Cambio
                            de topic, lorem ipsum lorem ipsum</span><span class="v825_34149">Eduard Chavarriaga</span>
                        <div class="v825_34150">
                            <div class="v825_34151"></div>
                        </div>
                    </div>
                    <div class="v825_34152"><span class="v825_34153">26/12/21 · 12:20</span><span class="v825_34154">Cierre
                            de ticket, lorem ipsum lorem ipsum</span><span class="v825_34155">Eduard Chavarriaga</span>
                        <div class="v825_34156">
                            <div class="v825_34157"></div>
                        </div>
                    </div>
                    <div class="v825_34158"><span class="v825_34159">26/12/21 · 12:20</span><span
                            class="v825_34160">Vencimiento SLA, lorem ipsum lorem ipsum</span><span
                            class="v825_34161">Eduard Chavarriaga</span>
                        <div class="v825_34162">
                            <div class="v825_34163"></div>
                        </div>
                    </div>
                    <div class="v825_34164"></div>
                    <div class="v825_34165"><span class="v825_34166">Nota Interna..</span></div>
                    <div class="v825_34167">
                        <div class="name"></div>
                        <div class="v825_34169">
                            <div class="v825_34170">
                                <div class="v825_34171"></div>
                            </div>
                        </div>
                    </div>
                    <div class="v825_34172"></div>
                </div>
                <div class="v825_34173">
                    <div class="v825_34174"><span class="v825_34175">Registro de ticket / #0427229</span>
                        <div class="name"></div>
                    </div>
                </div>
            </div>
            <div class="v825_34177"></div>
            <div class="v825_34178 chat-rigthsidebar">
                <div class="v825_34179"><span class="v825_34180">Bandeja de Tickets (24):</span>
                    <div class="v825_34181"><span class="v825_34182">Mis tickets</span>
                        <div class="name"></div>
                    </div>
                </div>
                <div class="v825_34610">
                    <div class="v825_34611">
                        <div class="v825_34612">
                            <div class="v825_34613">
                                <div class="v825_34614">
                                    <div class="v825_34615"></div>
                                </div>
                            </div>
                            <div class="v825_34616">
                                <div class="v825_34617">
                                    <div class="v825_34618">
                                        <div class="v825_34619"></div>
                                    </div>
                                </div><span class="v825_34620">Estado</span>
                            </div>
                            <div class="name"></div>
                        </div>
                        <div class="v825_34622">
                            <div class="v825_34623">
                                <div class="name"></div><span class="v825_34625">Asignar</span>
                            </div>
                            <div class="name"></div>
                        </div>
                        <div class="v825_34627">
                            <div class="name"></div><span class="v825_34629">Transferir</span>
                        </div>
                    </div>
                    <div class="v825_34630">
                        <div class="name"></div><span class="v825_34632">Acción2</span>
                    </div>
                </div>
                <div class="v825_34184">
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                    <div class="name"></div>
                </div>
            </div>
        </div>
        </div> <!-- container-fluid -->
      </div>
    </div>
  </div>
</div>
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cambiar estado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/chatcambiarestado" method="post">
          @csrf
          <input type="hidden" name="idticketestado" id="idticketestado" value="">
          <?php
          foreach ($estados as $value) {
          ?>

            <input class="form-radio" type="radio" name="statos" value="<?php echo $value->id; ?>"><?php echo $value->name; ?><br>

          <?php

          } ?>
          <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>



<div class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cambiar Departamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/chatcambiardeptos" method="post">
          @csrf
          <input type="hidden" name="idticketestado" id="idticketdepto" value="">
          <?php
          foreach ($deptos as $value) {
          ?>

            <input class="form-radio" type="radio" name="statos" value="<?php echo $value->id; ?>"><?php echo $value->name; ?><br>

          <?php

          } ?>
          <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div class="modal fade bs-example-modal-center3" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cambiar Topics</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/chatcambiartopic" method="post">
          @csrf
          <input type="hidden" name="idticketestado" id="idtickettopic" value="">
          <?php
          foreach ($topics as $value) {
          ?>

            <input class="form-radio" type="radio" name="statos" value="<?php echo $value->topic_id; ?>"><?php echo $value->topic; ?><br>

          <?php

          } ?>
          <button type="submit" class="btn btn-success
                                waves-effect waves-light">Cambiar</button>

        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<?php //dd($datos);
?>
<br><br><br>

@include('pp.footer')