<?php exit; ?>
d2lraVRoZW1lL1RpbmlXaWtpRGVmYXVsdA==	3	YW5vbnltb3Vz	127.0.0.1	1081324446	
! theme: TiniWikiDefault

* 제작자: [토끼군] 강 성훈 %%%
* 버전: version 0.12a (for TiniWiki 0.1.-152)

이 테마는 무진장 간단하게 만든 썰렁한(..) 테마입니다. 간단하기 때문에 부담 없이 쓸 수 있을 겁니다 :)

이 테마는 XHTML 1.1에 맞게 설계되어 있으며, Internet Explorer 6.0과 Mozilla Firefox 0.8에서 테스트되었습니다.

!! 설치법

이 테마는 TiniWiki에 기본적으로 포함되어 있습니다. 이 테마를 사용하려면 config.php에서 다음을 고치시면 됩니다.

{{
# path to your theme
$``wikiTheme = "__theme/default__";
}}

!! 입맛대로 바꾸기

* __대부분의 수정은 theme.css만 고치면 됩니다.__
* diff.php(diff 액션)의 경우 그 자체에도 코드가 들어 있기 때문에 주의하셔서 고치셔야 합니다.
* edit.php와 info.php, links1.php, links2.php의 경우 반복문을 제외한 코드는 고치셔도 무방합니다. (\<?=$변수?> 형태의 php 출력문은 유지하셔야 합니다.)
