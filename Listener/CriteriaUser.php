<?php

namespace ThemeHouse\UserCriteria\Listener;

use Carbon\Carbon;
use League\Uri\UriString;
use ThemeHouse\UserCriteria\Util\Color;
use XF\Entity\User;

/**
 * Class CriteriaUser
 * @package ThemeHouse\UserCriteria\Listener
 */
class CriteriaUser
{
    /**
     * @param $rule
     * @param array $data
     * @param User $user
     * @param $returnValue
     * @return null
     */
    public static function criteriaUser($rule, array $data, User $user, &$returnValue)
    {
        /** @var \ThemeHouse\UserCriteria\XF\Entity\User $user */

        $prefix = \XF::options()->thusercriteria_prefix;
        switch ($rule) {
            case $prefix . 'without_about_you':
                if (empty($user->Profile->about)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'with_about_you':
                if (!empty($user->Profile->about)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'without_signature':
                if (empty($user->Profile->signature)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'with_signature':
                if (!empty($user->Profile->signature)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'without_website':
                if (empty($user->Profile->website)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'with_website':
                if (!empty($user->Profile->website)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_open_reports':
                if ($user->thuc_open_report_count >= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_open_reports':
                if ($user->thuc_open_report_count <= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_closed_reports':
                if ($user->thuc_closed_report_count >= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_closed_reports':
                if ($user->thuc_closed_report_count <= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_reports':
                if ($user->thuc_report_count >= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_reports':
                if ($user->thuc_report_count <= $data[$prefix . 'report_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_active_warnings':
                if ($user->thuc_active_warning_count >= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_active_warnings':
                if ($user->thuc_active_warning_count <= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_expired_warnings':
                if ($user->thuc_expired_warning_count >= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_expired_warnings':
                if ($user->thuc_expired_warning_count <= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_warnings_recieved':
                if ($user->thuc_warning_count >= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_warnings_recieved':
                if ($user->thuc_warning_count <= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_warning_points':
                if ($user->warning_points >= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_warning_points':
                if ($user->warning_points <= $data[$prefix . 'warn_count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_state_not':
                if ($user->user_state !== $data['state']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_connected_accounts':
                if (empty(array_intersect_key(array_flip($data['provider_ids']), $user->Profile->connected_accounts))) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_language':
                if ($user->language_id !== $data['language_id']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'registered_max_days':
                if ($user->register_date) {
                    $registerDate = Carbon::createFromTimestamp($user->register_date);
                    if ($registerDate->diffInDays() <= $data['days']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'user_title':
                if (!empty($user->custom_title)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'no_user_title':
                if (empty($user->custom_title)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'tags':
                if ($user->thuc_tag_count >= $data['tags']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_tags':
                if ($user->thuc_tag_count <= $data['tags']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'threads':
                if ($user->thuc_thread_count >= $data['threads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_threads':
                if ($user->thuc_thread_count <= $data['threads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'following':
                if (count($user->Profile->following) >= $data['following']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_following':
                if (count($user->Profile->following) <= $data['following']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'ignoring':
                if (count($user->Profile->ignored) >= $data['ignored']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_ignoring':
                if (count($user->Profile->ignored) <= $data['ignored']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'follower':
                if ($user->thuc_follower_count >= $data['followers']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_follower':
                if ($user->thuc_follower_count <= $data['followers']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'always':
                $returnValue = true;
                break;

            case $prefix . 'never':
                $returnValue = false;
                break;

            case $prefix . 'not_username':
                $names = preg_split('/\s*,\s*/', utf8_strtolower($data['names']), -1, PREG_SPLIT_NO_EMPTY);
                if (!in_array(utf8_strtolower($user->username), $names)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_username_search':
                if (self::findNeedle($data['needles'], $user->username) === false) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'email_not_search':
                if (self::findNeedle($data['needles'], $user->email) === false) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'bookmarks':
                if ($user->thuc_bookmark_count >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_bookmarks':
                if ($user->thuc_bookmark_count <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_media_count':
                if (!empty(\XF::app()->container('addon.cache')['XFMG'])) {
                    if (isset($user->xfmg_media_count) && $user->xfmg_media_count <= $data['media_items']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_album_count':
                if (!empty(\XF::app()->container('addon.cache')['XFMG'])) {
                    if (isset($user->xfmg_album_count) && $user->xfmg_album_count <= $data['albums']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_resources':
                if (!empty(\XF::app()->container('addon.cache')['XFRM'])) {
                    if (isset($user->xfrm_resource_count) && $user->xfrm_resource_count <= $data['resources']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_trophy_points':
                if (isset($user->trophy_points) && $user->trophy_points <= $data['points']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'style_ids':
                if (!empty($data['style_ids']) && in_array(\XF::visitor()->style_id, $data['style_ids'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_style_ids':
                if (!empty($data['style_ids']) && !in_array(\XF::visitor()->style_id, $data['style_ids'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'language_ids':
                if (!empty($data['language_ids']) && in_array(\XF::visitor()->language_id, $data['language_ids'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_language_ids':
                if (!empty($data['language_ids']) && !in_array(\XF::visitor()->language_id, $data['language_ids'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'username_regex':
                if (@preg_match($data['regex'], $user->username)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_username_regex':
                if (!@preg_match($data['regex'], $user->username)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_title_regex':
                if (@preg_match($data['regex'], $user->custom_title)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_user_title_regex':
                if (!@preg_match($data['regex'], $user->custom_title)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'num_connected_accounts':
                if (count($user->Profile->connected_accounts) >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'num_max_connected_accounts':
                if (count($user->Profile->connected_accounts) <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'staff':
                if ($user->is_staff) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_staff':
                if (!$user->is_staff) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'password_min_age':
                $passwordAge = Carbon::createFromTimestamp($user->Profile->password_date);
                if ($passwordAge->diffInDays() >= $data['days']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'password_max_age':
                $passwordAge = Carbon::createFromTimestamp($user->Profile->password_date);
                if ($passwordAge->diffInDays() <= $data['days']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'location':
                if (!empty($user->Profile->location)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_location':
                if (empty($user->Profile->location)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'birth_day':
                $birthday = $user->Profile->getBirthday(true);
                if (isset($birthday['timeStamp']))
                {
                    $birthday = $birthday['timeStamp'];

                    $birthday = Carbon::createFromTimestamp($birthday);
                    if ($birthday->day == $data['day']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'birth_month':
                $birthday = $user->Profile->getBirthday(true);
                if (isset($birthday['timeStamp']))
                {
                    $birthday = $birthday['timeStamp'];

                    $birthday = Carbon::createFromTimestamp($birthday);
                    if ($birthday->month == $data['month']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'birth_year':
                $birthday = $user->Profile->getBirthday(true);
                if (isset($birthday['timeStamp']))
                {
                    $birthday = $birthday['timeStamp'];

                    $birthday = Carbon::createFromTimestamp($birthday);
                    if ($birthday->year == $data['year']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'user_upgrades':
                if ($user->thuc_has_active_user_upgrade) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_user_upgrades':
                if (!$user->thuc_has_active_user_upgrade) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_expired_user_upgrades':
                if ($user->thuc_expired_user_upgrade_count >= $data['upgrades']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_expired_user_upgrades':
                if ($user->thuc_expired_user_upgrade_count <= $data['upgrades']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_upgrade_expiring_in':
                if ($timestamp = $user->thuc_next_user_upgrade_expiry_date) {
                    $expiryDate = Carbon::createFromTimestamp($user->thuc_next_user_upgrade_expiry_date);
                    if ($expiryDate->diffInDays() <= $data['days']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'push_notifications':
                if ($user->thuc_has_push_subscription) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_push_notifications':
                if (!$user->thuc_has_push_subscription) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'super_administrator':
                if ($user->thuc_is_super_admin) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_super_administrator':
                if (!$user->thuc_is_super_admin) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'api_key':
                if ($user->thuc_has_api_key) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'not_api_key':
                if (!$user->thuc_has_api_key) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_react_score':
                if ($user->reaction_score <= $data['reactions']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_react_ratio':
                if (!$user->message_count || !$user->reaction_score) {
                    return false;
                }

                $ratio = $user->reaction_score / $user->message_count;
                if ($ratio <= $data['ratio']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'unread_conversations':
                if ($user->conversations_unread >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_unread_conversations':
                if ($user->conversations_unread <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'polls':
                if (\XF::db()->fetchOne('SELECT count(*) FROM xf_poll_vote WHERE user_id = ?',
                        [$user->user_id]) >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_polls':
                if (\XF::db()->fetchOne('SELECT count(*) FROM xf_poll_vote WHERE user_id = ?',
                        [$user->user_id]) <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_visible':
                if ($user->activity_visible) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_invisible':
                if (!$user->activity_visible) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_threads_watched':
                if ($user->getThucWatchCountForContent('threads') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_threads_watched':
                if ($user->getThucWatchCountForContent('threads') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_forums_watched':
                if ($user->getThucWatchCountForContent('forums') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_forums_watched':
                if ($user->getThucWatchCountForContent('forums') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_categories_watched':
                if ($user->getThucWatchCountForContent('xfrm_categories') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_categories_watched':
                if ($user->getThucWatchCountForContent('xfrm_categories') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_resources_watched':
                if ($user->getThucWatchCountForContent('xfrm_resources') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_resources_watched':
                if ($user->getThucWatchCountForContent('xfrm_resources') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_categories_watched':
                if ($user->getThucWatchCountForContent('xfmg_categories') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_categories_watched':
                if ($user->getThucWatchCountForContent('xfmg_categories') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_albums_watched':
                if ($user->getThucWatchCountForContent('xfmg_albums') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_albums_watched':
                if ($user->getThucWatchCountForContent('xfmg_albums') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_watched':
                if ($user->getThucWatchCountForContent('xfmg_media') >= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_watched':
                if ($user->getThucWatchCountForContent('xfmg_media') <= $data['watched']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'has_trophy':
                if (!empty(array_intersect($user->thuc_trophy_ids, array_map("intval", $data['trophies'])))) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'has_not_trophy':
                if (empty(array_intersect($user->thuc_trophy_ids, array_map("intval", $data['trophies'])))) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'has_trophies':
                $earntTrophies = $user->thuc_trophy_ids;
                $needsTrophies = array_map("intval", $data['trophies']);
                $earntNeededTrophies = array_intersect($needsTrophies, $earntTrophies);

                sort($earntNeededTrophies);
                sort($needsTrophies);

                if ($earntNeededTrophies == $needsTrophies) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_replies':
                if ($user->thuc_thread_reply_total_count >= $data['replies']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_replies':
                if ($user->thuc_thread_reply_total_count <= $data['replies']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_reply_max':
                if ($user->thuc_thread_reply_max_count >= $data['replies']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_reply_max':
                if ($user->thuc_thread_reply_max_count <= $data['replies']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_profile_posts':
                if ($user->thuc_profile_post_count >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_profile_posts':
                if ($user->thuc_profile_post_count <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_profile_post_comments':
                if ($user->thuc_profile_post_comment_count >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_profile_post_comments':
                if ($user->thuc_profile_post_comment_count <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_attachments':
                if ($user->thuc_attachment_count >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_attachments':
                if ($user->thuc_attachment_count <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_forum_threads_oneof':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodeThreadCount($nodeId) >= $data['threads']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_forum_threads_oneof':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodeThreadCount($nodeId) <= $data['threads']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_forum_threads_combined':
                $total = 0;
                foreach ($data['nodes'] as $nodeId) {
                    $total += $user->getThucNodeThreadCount($nodeId);
                }
                if ($total >= $data['threads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_forum_threads_combined':
                $total = 0;
                foreach ($data['nodes'] as $nodeId) {
                    $total += $user->getThucNodeThreadCount($nodeId);
                }
                if ($total <= $data['threads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_forum_threads_each':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodeThreadCount($nodeId) < $data['threads']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_forum_threads_each':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodeThreadCount($nodeId) > $data['threads']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_forum_posts_oneof':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodePostCount($nodeId) >= $data['posts']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_forum_posts_oneof':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodePostCount($nodeId) <= $data['posts']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_forum_posts_combined':
                $total = 0;
                foreach ($data['nodes'] as $nodeId) {
                    $total += $user->getThucNodePostCount($nodeId);
                }
                if ($total >= $data['posts']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_forum_posts_combined':
                $total = 0;
                foreach ($data['nodes'] as $nodeId) {
                    $total += $user->getThucNodePostCount($nodeId);
                }
                if ($total <= $data['posts']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_forum_posts_each':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodePostCount($nodeId) < $data['posts']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_forum_posts_each':
                foreach ($data['nodes'] as $nodeId) {
                    if ($user->getThucNodePostCount($nodeId) > $data['posts']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_reactions_received_oneof':
                if (!empty($data['reactions'])) {
                    foreach ($data['reactions'] as $reactionId) {
                        if ($user->getThucReceivedReactionCount($reactionId) >= $data['count']) {
                            $returnValue = true;
                            break 2;
                        }
                    }
                }
                break;

            case $prefix . 'max_reactions_received_oneof':
                if (!empty($data['reactions'])) {
                    foreach ($data['reactions'] as $reactionId) {
                        if ($user->getThucReceivedReactionCount($reactionId) <= $data['count']) {
                            $returnValue = true;
                            break 2;
                        }
                    }
                }
                break;

            case $prefix . 'min_reactions_given_oneof':
                if (!empty($data['reactions'])) {
                    foreach ($data['reactions'] as $reactionId) {
                        if ($user->getThucGivenReactionCount($reactionId) >= $data['count']) {
                            $returnValue = true;
                            break 2;
                        }
                    }
                }
                break;

            case $prefix . 'max_reactions_given_oneof':
                if (!empty($data['reactions'])) {
                    foreach ($data['reactions'] as $reactionId) {
                        if ($user->getThucGivenReactionCount($reactionId) <= $data['count']) {
                            $returnValue = true;
                            break 2;
                        }
                    }
                }
                break;

            case $prefix . 'min_reactions_given_combined':
                if (!empty($data['reactions'])) {
                    $total = 0;
                    foreach ($data['reactions'] as $reactionId) {
                        $total += $user->getThucGivenReactionCount($reactionId);
                    }
                    if ($total >= $data['count']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_reactions_given_combined':
                if (!empty($data['reactions'])) {
                    $total = 0;
                    foreach ($data['reactions'] as $reactionId) {
                        $total += $user->getThucGivenReactionCount($reactionId);
                    }
                    if ($total <= $data['count']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'min_reactions_received_combined':
                if (!empty($data['reactions'])) {
                    $total = 0;
                    foreach ($data['reactions'] as $reactionId) {
                        $total += $user->getThucReceivedReactionCount($reactionId);
                    }
                    if ($total >= $data['count']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_reactions_received_combined':
                if (!empty($data['reactions'])) {
                    $total = 0;
                    foreach ($data['reactions'] as $reactionId) {
                        $total += $user->getThucReceivedReactionCount($reactionId);
                    }
                    if ($total <= $data['count']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'min_reactions_received_each':
                if (!empty($data['reactions'])) {
                    foreach ($data['reactions'] as $reactionId) {
                        if ($user->getThucReceivedReactionCount($reactionId) < $data['count']) {
                            $returnValue = false;
                            break 2;
                        }
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_reactions_received_each':
                if (!empty($data['reactions'])) {
                    foreach ($data['reactions'] as $reactionId) {
                        if ($user->getThucReceivedReactionCount($reactionId) > $data['count']) {
                            $returnValue = false;
                            break 2;
                        }
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_reactions_given_each':
                if (!empty($data['reactions'])) {
                    foreach ($data['reactions'] as $reactionId) {
                        if ($user->getThucGivenReactionCount($reactionId) < $data['count']) {
                            $returnValue = false;
                            break 2;
                        }
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_reactions_given_each':
                if (!empty($data['reactions'])) {
                    foreach ($data['reactions'] as $reactionId) {
                        if ($user->getThucGivenReactionCount($reactionId) > $data['count']) {
                            $returnValue = false;
                            break 2;
                        }
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_posts_in_threads':
                $postCounts = $user->getThucReplyCountsForThreads(array_column($data, 'thread'));

                foreach ($data as $thread) {
                    if (!$thread['thread'] || !$thread['count']) {
                        continue;
                    }

                    if (!$postCounts[$thread['thread']] || $postCounts[$thread['thread']] < $thread['count']) {
                        break 2;
                    }
                }

                $returnValue = true;
                break;

            case $prefix . 'max_posts_in_threads':
                $postCounts = $user->getThucReplyCountsForThreads(array_column($data, 'thread'));

                foreach ($data as $thread) {
                    if (!$thread['thread'] || !$thread['count']) {
                        continue;
                    }

                    if (!$postCounts[$thread['thread']] || $postCounts[$thread['thread']] > $thread['count']) {
                        break 2;
                    }
                }

                $returnValue = true;
                break;

            case $prefix . 'min_xfrm_highest_downloads':
                if ($user->thuc_xfrm_resource_highest_download_count >= $data['downloads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_highest_downloads':
                if ($user->thuc_xfrm_resource_highest_download_count <= $data['downloads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_total_downloads':
                if ($user->thuc_xfrm_resource_download_count >= $data['downloads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_total_downloads':
                if ($user->thuc_xfrm_resource_download_count <= $data['downloads']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_highest_views':
                if ($user->thuc_xfrm_resource_highest_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_highest_views':
                if ($user->thuc_xfrm_resource_highest_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_total_views':
                if ($user->thuc_xfrm_resource_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_total_views':
                if ($user->thuc_xfrm_resource_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_highest_rating':
                if ($user->thuc_xfrm_resource_highest_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_highest_rating':
                if ($user->thuc_xfrm_resource_highest_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_average_rating':
                if ($user->thuc_xfrm_resource_average_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_average_rating':
                if ($user->thuc_xfrm_resource_average_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_updates':
                if ($user->thuc_xfrm_resource_update_count >= $data['updates']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_updates':
                if ($user->thuc_xfrm_resource_update_count <= $data['updates']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_reviews':
                if ($user->thuc_xfrm_resource_review_count >= $data['reviews']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_reviews':
                if ($user->thuc_xfrm_resource_review_count <= $data['reviews']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfrm_given_reviews':
                if ($user->thuc_xfrm_resource_given_review_count >= $data['reviews']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfrm_given_reviews':
                if ($user->thuc_xfrm_resource_given_review_count <= $data['reviews']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_views':
                if ($user->thuc_xfmg_album_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_views':
                if ($user->thuc_xfmg_album_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_highest_views':
                if ($user->thuc_xfmg_album_highest_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_highest_views':
                if ($user->thuc_xfmg_album_highest_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_views':
                if ($user->thuc_xfmg_media_item_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_views':
                if ($user->thuc_xfmg_media_item_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_highest_views':
                if ($user->thuc_xfmg_media_item_highest_view_count >= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_highest_views':
                if ($user->thuc_xfmg_media_item_highest_view_count <= $data['views']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_comments':
                if ($user->thuc_xfmg_album_comment_count >= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_comments':
                if ($user->thuc_xfmg_album_comment_count <= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_highest_comments':
                if ($user->thuc_xfmg_album_highest_comment_count >= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_highest_comments':
                if ($user->thuc_xfmg_album_highest_comment_count <= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_comments':
                if ($user->thuc_xfmg_media_item_comment_count >= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_comments':
                if ($user->thuc_xfmg_media_item_comment_count <= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_highest_comments':
                if ($user->thuc_xfmg_media_item_highest_comment_count >= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_highest_comments':
                if ($user->thuc_xfmg_media_item_highest_comment_count <= $data['comments']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_highest_album_rating':
                if ($user->thuc_xfmg_album_highest_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_highest_album_rating':
                if ($user->thuc_xfmg_album_highest_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_average_album_rating':
                if ($user->thuc_xfmg_album_average_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_average_album_rating':
                if ($user->thuc_xfmg_album_average_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_highest_item_rating':
                if ($user->thuc_xfmg_media_item_highest_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_highest_item_rating':
                if ($user->thuc_xfmg_media_item_highest_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_average_item_rating':
                if ($user->thuc_xfmg_media_item_average_rating >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_average_item_rating':
                if ($user->thuc_xfmg_media_item_average_rating <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_rating_count':
                if ($user->thuc_xfmg_album_rating_count >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_rating_count':
                if ($user->thuc_xfmg_album_rating_count <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_album_rating_given_count':
                if ($user->thuc_xfmg_album_rating_given_count >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_album_rating_given_count':
                if ($user->thuc_xfmg_album_rating_given_count <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_rating_count':
                if ($user->thuc_xfmg_media_item_rating_count >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_rating_count':
                if ($user->thuc_xfmg_media_item_rating_count <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_xfmg_media_item_rating_given_count':
                if ($user->thuc_xfmg_media_item_rating_given_count >= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_xfmg_media_item_rating_given_count':
                if ($user->thuc_xfmg_media_item_rating_given_count <= $data['rating']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_resource_category_oneof':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfrmResourceCountForCategory($categoryId) >= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_resource_category_oneof':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfrmResourceCountForCategory($categoryId) <= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_resource_category_combined':
                $total = 0;
                foreach ($data['categories'] as $categoryId) {
                    $total += $user->getThucXfrmResourceCountForCategory($categoryId);
                }
                if ($total >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_resource_category_combined':
                $total = 0;
                foreach ($data['categories'] as $categoryId) {
                    $total += $user->getThucXfrmResourceCountForCategory($categoryId);
                }
                if ($total <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_resource_category_each':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfrmResourceCountForCategory($categoryId) < $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_resource_category_each':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfrmResourceCountForCategory($categoryId) > $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'min_media_item_category_oneof':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfmgItemCountForCategory($categoryId) >= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'max_media_item_category_oneof':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfmgItemCountForCategory($categoryId) <= $data['count']) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'min_media_item_category_combined':
                $total = 0;
                foreach ($data['categories'] as $categoryId) {
                    $total += $user->getThucXfmgItemCountForCategory($categoryId);
                }
                if ($total >= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_media_item_category_combined':
                $total = 0;
                foreach ($data['categories'] as $categoryId) {
                    $total += $user->getThucXfmgItemCountForCategory($categoryId);
                }
                if ($total <= $data['count']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'min_media_item_category_each':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfmgItemCountForCategory($categoryId) < $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'max_media_item_category_each':
                foreach ($data['categories'] as $categoryId) {
                    if ($user->getThucXfmgItemCountForCategory($categoryId) > $data['count']) {
                        $returnValue = false;
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'age':
                if ($user->Profile->dob_year && $user->Profile->dob_month && $user->Profile->dob_day) {
                    $birthday = (new Carbon())
                        ->setDay($user->Profile->dob_day)
                        ->setMonth($user->Profile->dob_month)
                        ->setYear($user->Profile->dob_year)
                        ->startOfDay();

                    if ($birthday->diffInYears() >= $data['years']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'max_age':
                if ($user->Profile->dob_year && $user->Profile->dob_month && $user->Profile->dob_day) {
                    $birthday = (new Carbon())
                        ->setDay($user->Profile->dob_day)
                        ->setMonth($user->Profile->dob_month)
                        ->setYear($user->Profile->dob_year)
                        ->startOfDay();

                    if ($birthday->diffInYears() <= $data['years']) {
                        $returnValue = true;
                    }
                }
                break;

            case $prefix . 'last_activity':
                $lastActivity = Carbon::createFromTimestamp($user->last_activity);
                $compare = Carbon::now();

                if (isset($data['minutes']) && $data['minutes']) {
                    $compare->subMinutes($data['minutes']);
                }
                if (isset($data['hours']) && $data['hours']) {
                    $compare->subHours($data['hours']);
                }
                if (isset($data['days']) && $data['days']) {
                    $compare->subDays($data['days']);
                }
                if (isset($data['weeks']) && $data['weeks']) {
                    $compare->subWeeks($data['weeks']);
                }
                if (isset($data['months']) && $data['months']) {
                    $compare->subMonths($data['months']);
                }
                if (isset($data['years']) && $data['years']) {
                    $compare->subYears($data['years']);
                }

                if ($lastActivity->greaterThanOrEqualTo($compare)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_last_activity':
                $lastActivity = Carbon::createFromTimestamp($user->last_activity);
                $compare = Carbon::now();

                if (isset($data['minutes']) && $data['minutes']) {
                    $compare->subMinutes($data['minutes']);
                }
                if (isset($data['hours']) && $data['hours']) {
                    $compare->subHours($data['hours']);
                }
                if (isset($data['days']) && $data['days']) {
                    $compare->subDays($data['days']);
                }
                if (isset($data['weeks']) && $data['weeks']) {
                    $compare->subWeeks($data['weeks']);
                }
                if (isset($data['months']) && $data['months']) {
                    $compare->subMonths($data['months']);
                }
                if (isset($data['years']) && $data['years']) {
                    $compare->subYears($data['years']);
                }

                if ($lastActivity->lessThan($compare)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'posts_days':
                if ($data['posts'] <= $user->getThucPostsDays($data['days'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_posts_days':
                if ($data['posts'] >= $user->getThucPostsDays($data['days'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'posts_days_forums':
                if ($data['posts'] <= $user->getThucPostsDaysForums($data['days'], $data['nodes'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_posts_days_forums':
                if ($data['posts'] >= $user->getThucPostsDaysForums($data['days'], $data['nodes'])) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'registered_before_date':
                $registerDate = Carbon::createFromTimestamp($user->register_date);
                $date = new Carbon($data['date']);
                if ($registerDate->isBefore($date)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'registered_after_date':
                $registerDate = Carbon::createFromTimestamp($user->register_date);
                $date = new Carbon($data['date']);
                if ($registerDate->isAfter($date)) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'user_id':
                if ($user->user_id >= $data['value']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'max_user_id':
                if ($user->user_id <= $data['value']) {
                    $returnValue = true;
                }
                break;

            case $prefix . 'following_user_one_of':
                foreach (self::getUsers($data['names']) as $followedUser) {
                    if ($user->isFollowing($followedUser)) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'following_user_none_of':
                foreach (self::getUsers($data['names']) as $followedUser) {
                    if ($user->isFollowing($followedUser)) {
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'following_user_all_of':
                foreach (self::getUsers($data['names']) as $followedUser) {
                    if (!$user->isFollowing($followedUser)) {
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'ignoring_user_one_of':
                foreach (self::getUsers($data['names']) as $ignoredUser) {
                    if ($user->isIgnoring($ignoredUser)) {
                        $returnValue = true;
                        break 2;
                    }
                }
                break;

            case $prefix . 'ignoring_user_none_of':
                foreach (self::getUsers($data['names']) as $ignoredUser) {
                    if ($user->isIgnoring($ignoredUser)) {
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            case $prefix . 'ignoring_user_all_of':
                foreach (self::getUsers($data['names']) as $ignoredUser) {
                    if (!$user->isIgnoring($ignoredUser)) {
                        break 2;
                    }
                }
                $returnValue = true;
                break;

            default:
                $prefixLength = strlen($prefix) + 11;
                if (substr($rule, 0, $prefixLength) === $prefix . 'user_field_') {
                    self::criteriaCustom(explode('_', substr($rule, $prefixLength)), $data, $user, $returnValue);
                }
                break;
        }

        return null;
    }

    protected static function getUsers($userNames)
    {
        /** @var \XF\Repository\User $userRepo */
        $userRepo = \XF::repository('XF:User');
        return $userRepo->getUsersByNames(array_map('trim', explode(',', $userNames)));
    }

    /**
     * @param $needleList
     * @param $haystack
     * @return bool
     */
    protected static function findNeedle($needleList, $haystack)
    {
        $haystack = utf8_strtolower($haystack);

        foreach (preg_split('/\s*,\s*/', utf8_strtolower($needleList), -1, PREG_SPLIT_NO_EMPTY) as $needle) {
            if (strpos($haystack, $needle) !== false) {
                return $needle;
            }
        }

        return false;
    }

    /**
     * @param array $ruleInput
     * @param array $data
     * @param User $user
     * @param $returnValue
     */
    public static function criteriaCustom(array $ruleInput, array $data, User $user, &$returnValue)
    {
        $rule = array_shift($ruleInput);
        $field = join('_', $ruleInput);
        $value = $user->Profile->custom_fields[$field];

        switch ($rule) {
            case 'checked':
                if ($value) {
                    $returnValue = true;
                }
                break;

            case 'unchecked':
                if (!$value) {
                    $returnValue = true;
                }
                break;

            case 'preg-match':
                if (@preg_match($data['regex'], $value)) {
                    $returnValue = true;
                }
                break;

            case 'radio-below':
                if ($value < $data['threshold']) {
                    $returnValue = true;
                }
                break;

            case 'radio-above':
                if ($value > $data['threshold']) {
                    $returnValue = true;
                }
                break;

            case 'email-domain':
                $mail = explode('@', $value);
                $domain = array_pop($mail);
                if ($domain === $data['text']) {
                    $returnValue = true;
                }
                break;

            case 'color-red-above':
                if (Color::isValidColor($value) && Color::getRedValue($value) > $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-green-above':
                if (Color::isValidColor($value) && Color::getGreenValue($value) > $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-blue-above':
                if (Color::isValidColor($value) && Color::getBlueValue($value) > $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-red-below':
                if (Color::isValidColor($value) && Color::getRedValue($value) < $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-green-below':
                if (Color::isValidColor($value) && Color::getGreenValue($value) < $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'color-blue-below':
                if (Color::isValidColor($value) && Color::getBlueValue($value) < $data['value']) {
                    $returnValue = true;
                }
                break;

            case 'date-day-equals':
                $date = new Carbon($value);
                if ($date->day == +$data['day']) {
                    $returnValue = true;
                }
                break;

            case 'date-month-equals':
                $date = new Carbon($value);
                if ($date->month == +$data['month']) {
                    $returnValue = true;
                }
                break;

            case 'date-year-equals':
                $date = new Carbon($value);
                if ($date->year == +$data['year']) {
                    $returnValue = true;
                }
                break;

            case 'date-before':
                $date = new Carbon($value);
                $target = new Carbon($data['date']);
                if ($date->isBefore($target)) {
                    $returnValue = true;
                }
                break;

            case 'date-after':
                $date = new Carbon($value);
                $target = new Carbon($data['date']);
                if ($date->isAfter($target)) {
                    $returnValue = true;
                }
                break;

            case 'date-days-past':
                $date = new Carbon($value);
                if ($date->isPast() && $date->diffInDays() >= $data['days']) {
                    $returnValue = true;
                }
                break;

            case 'date-max-days-past':
                $date = new Carbon($value);
                if ($date->isPast() && $date->diffInDays() <= $data['days']) {
                    $returnValue = true;
                }
                break;

            case 'date-days-future':
                $date = new Carbon($value);
                if ($date->isFuture() && $date->diffInDays() >= $data['days']) {
                    $returnValue = true;
                }
                break;

            case 'date-max-days-future':
                $date = new Carbon($value);
                if ($date->isFuture() && $date->diffInDays() <= $data['days']) {
                    $returnValue = true;
                }
                break;

            case 'url-http':
                if (UriString::parse($value)['scheme'] === 'http') {
                    $returnValue = true;
                }
                break;

            case 'url-https':
                if (UriString::parse($value)['scheme'] === 'https') {
                    $returnValue = true;
                }
                break;

            case 'url-tld':
                $domain = explode('.', UriString::parse($value)['host']);
                $tld = end($domain);
                $tlds = array_map('trim', explode(',', $data['domains']));
                if (in_array($tld, $tlds)) {
                    $returnValue = true;
                }
                break;

            case 'url-not-tld':
                $domain = explode('.', UriString::parse($value)['host']);
                $tld = end($domain);
                $tlds = array_map('trim', explode(',', $data['domains']));
                if (!in_array($tld, $tlds)) {
                    $returnValue = true;
                }
                break;

            default:
                break;
        }
    }
}
