# フロントエンドに関して

Blade テンプレートでコンポーネント切りながら作っています。

2021/10/24 時点

pwd;find . | sort | sed '1d;s/^\.//;s/\/\([^/]_\)$/|--\1/;s/\/[^/|]_/| /g'

で作成

```
|--api
|  |--api-token-manager.blade.php
|  |--index.blade.php
|--auth
|  |--confirm-password.blade.php
|  |--forgot-password.blade.php
|  |--login.blade.php
|  |--register.blade.php
|  |--reset-password.blade.php
|  |--two-factor-challenge.blade.php
|  |--verify-email.blade.php
|--components
|  |--buttons
|  |  |--editDiaryButton.blade.php
|  |  |--editorDiaryButton.blade.php
|  |--diary
|  |  |--breadcrumbDate.blade.php
|  |  |--diaryFrame.blade.php
|  |  |--latestDiaryContent.blade.php
|  |  |--submitForm.blade.php
|  |--footer.blade.php
|  |--noLogIn
|  |  |--explain.blade.php
|  |  |--news.blade.php
|  |  |--releaseNote.blade.php
|  |--settingHeading.blade.php
|  |--statisticHeading.blade.php
|  |--statistics
|  |  |--char
|  |  |  |--causeEffectChar.blade.php
|  |  |  |--classificationsChar.blade.php
|  |  |  |--emotionsChar.blade.php
|  |  |  |--emotionsRateChar.blade.php
|  |  |  |--flavorChar.blade.php
|  |  |  |--importantWordsChar.blade.php
|  |  |  |--specialPeopleChar.blade.php
|  |  |--frame
|  |  |  |--statisticFrameForArchive.blade.php
|  |  |--graph
|  |  |  |--classificationsGraph.blade.php
|  |  |  |--emotionsChangeGraph.blade.php
|  |  |  |--numberOfCharactersGraph.blade.php
|  |  |  |--partOfSpeechGraph.blade.php
|  |  |  |--wordCountsGraph.blade.php
|  |  |  |--writingRateGraph.blade.php
|  |  |--progress
|  |  |  |--progressDiariesCount.blade.php
|  |  |  |--progressGraph.blade.php
|  |  |--rank
|  |  |  |--top3Rank.blade.php
|  |  |--statisticOverallView.blade.php
|--customFunctions
|  |--omitContent.blade.php
|--dashboard.blade.php
|--diary
|  |--archive
|  |  |--monthArchive.blade.php
|  |  |--yearArchive.blade.php
|  |--edit.blade.php
|  |--home.blade.php
|  |--io
|  |  |--afterExport.blade.php
|  |  |--afterImport.blade.php
|  |--newDiary.blade.php
|--diaryNoLogIn
|  |--aboutThisSite.blade.php
|  |--contact.blade.php
|  |--news.blade.php
|  |--privacyPolicy.blade.php
|  |--releaseNote.blade.php
|  |--terms.blade.php
|  |--top.blade.php
|  |--search
|  |  |--detailSearch.blade.php
|  |  |--searchResult.blade.php
|  |--setting.blade.php
|  |--statistics
|  |  |--settingsStatistics.blade.php
|  |  |--topStatistics.blade.php
|--errors
|  |--403.blade.php
|  |--404.blade.php
|  |--413.blade.php
|  |--419.blade.php
|  |--429.blade.php
|  |--500.blade.php
|  |--503.blade.php
|--layouts
|  |--app.blade.php
|  |--guest.blade.php
|  |--main.blade.php
|  |--noLogIn.blade.php
|  |--OLDmain.blade.php
|--navigation-menu.blade.php
|--policy.blade.php
|--profile
|  |--delete-user-form.blade.php
|  |--logout-other-browser-sessions-form.blade.php
|  |--show.blade.php
|  |--two-factor-authentication-form.blade.php
|  |--update-password-form.blade.php
|  |--update-profile-information-form.blade.php
|--terms.blade.php
|--vendor
|  |--jetstream
|  |  |--components
|  |  |  |--action-message.blade.php
|  |  |  |--action-section.blade.php
|  |  |  |--application-logo.blade.php
|  |  |  |--application-mark.blade.php
|  |  |  |--authentication-card.blade.php
|  |  |  |--authentication-card-logo.blade.php
|  |  |  |--banner.blade.php
|  |  |  |--button.blade.php
|  |  |  |--checkbox.blade.php
|  |  |  |--confirmation-modal.blade.php
|  |  |  |--confirms-password.blade.php
|  |  |  |--danger-button.blade.php
|  |  |  |--dialog-modal.blade.php
|  |  |  |--dropdown.blade.php
|  |  |  |--dropdown-link.blade.php
|  |  |  |--form-section.blade.php
|  |  |  |--input.blade.php
|  |  |  |--input-error.blade.php
|  |  |  |--label.blade.php
|  |  |  |--modal.blade.php
|  |  |  |--nav-link.blade.php
|  |  |  |--responsive-nav-link.blade.php
|  |  |  |--secondary-button.blade.php
|  |  |  |--section-border.blade.php
|  |  |  |--section-title.blade.php
|  |  |  |--switchable-team.blade.php
|  |  |  |--validation-errors.blade.php
|  |  |  |--welcome.blade.php
|  |  |--mail
|  |  |  |--team-invitation.blade.php
|--welcome.blade.php
```
